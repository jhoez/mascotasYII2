<?php
namespace frontend\controllers;

use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use frontend\models\LoginForm;
use frontend\models\Usuario;
use frontend\models\Mascota;
use frontend\models\Direccion;
use frontend\models\Discapacidad;
use frontend\models\Especies;
use frontend\models\Estatus;
use frontend\models\Islas;
use frontend\models\Procedencia;
use frontend\models\Propietario;
use frontend\models\Tratamiento;
use frontend\models\Calle;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $mascota        = new Mascota;
        $direccion      = new Direccion;
        $discapacidad   = new Discapacidad;
        $especies       = new Especies;
        $tipo_especies  = Estatus::find()->asArray()->where(['id_padre' => 1])->all();
        $selec          = Estatus::find()->asArray()->where(['id_padre' => 4])->all();
        $sexo           = Estatus::find()->asArray()->where(['id_padre' => 7])->all();
        $islas          = Islas::find()->asArray()->all();
        $procedencia    = Procedencia::find()->asArray()->all();
        $propietario    = new Propietario;
        $tratamiento    = new Tratamiento;
        $calle          = Calle::find()->asArray()->all();

        //$propietario->attributes = Yii::$app->request->post('Propietario');
        if (
            $propietario->load(Yii::$app->request->post()) &&// poblar los atributos del modelo desde la entrada del usuario
            $direccion->load(Yii::$app->request->post()) &&
            $especies->load(Yii::$app->request->post()) &&
            $mascota->load(Yii::$app->request->post()) &&
            $discapacidad->load(Yii::$app->request->post()) &&
            $tratamiento->load(Yii::$app->request->post())
        ) {

            if (
                $propietario->validate() &&
                $direccion->validate() &&
                $especies->validate() &&
                $mascota->validate() &&
                $discapacidad->validate() &&
                $tratamiento->validate()
            ) {
                $propietario->registrar();
                $direccion->registrar();
                $especies->registrar();
                $mascota = $mascota->registrar();
                $discapacidad->registrar();
                $tratamiento->registrar();
                Yii::$app->session->setFlash('success', '¡Se ha registrado una Mascota!');
                return $this->redirect(['view', 'id' => $mascota->idmasc]);
            }
        }

        return $this->render('index',[
            'mascota'       => $mascota,
            'direccion'     => $direccion,
            'discapacidad'  => $discapacidad,
            'especies'      => $especies,
            'tipo_especies' => $tipo_especies,
            'selec'         => $selec,
            'sexo'          => $sexo,
            'islas'         => $islas,
            'procedencia'   => $procedencia,
            'propietario'   => $propietario,
            'tratamiento'   => $tratamiento,
            'calle'         => $calle
        ]);
    }

    public function actionLogin(){
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $form=new LoginForm();
        if ( $form->load(yii::$app->request->post()) ){
            if ($form->validate()){
                $login=Usuario::find()->where(['username'=>$form->username,'password'=>$form->password])->one();
                if (!empty($login)){
                    yii::$app->user->login($login);
                    return $this->redirect(['site/index']);
                }else{
                    yii::$app->session->setFlash('error','Usuario o contraseña incorrecto');
                }
            }
        }
        return $this->render('login',['form'=>$form]);
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('success', 'Thank you for registration. Please check your inbox for verification email.');
            return $this->goHome();
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * Verify email address
     *
     * @param string $token
     * @throws BadRequestHttpException
     * @return yii\web\Response
     */
    public function actionVerifyEmail($token)
    {
        try {
            $model = new VerifyEmailForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if ($user = $model->verifyEmail()) {
            if (Yii::$app->user->login($user)) {
                Yii::$app->session->setFlash('success', 'Your email has been confirmed!');
                return $this->goHome();
            }
        }

        Yii::$app->session->setFlash('error', 'Sorry, we are unable to verify your account with provided token.');
        return $this->goHome();
    }

    /**
     * Resend verification email
     *
     * @return mixed
     */
    public function actionResendVerificationEmail()
    {
        $model = new ResendVerificationEmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            }
            Yii::$app->session->setFlash('error', 'Sorry, we are unable to resend verification email for the provided email address.');
        }

        return $this->render('resendVerificationEmail', [
            'model' => $model
        ]);
    }
}
