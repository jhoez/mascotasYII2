<?php

namespace frontend\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
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
 * MascotaController implements the CRUD actions for Mascota model.
 */
class MascotaController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index','view','logout','create','estadistica','update','delete'],
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
    * crea un pdf o excel
    * @return PDF
    */
    public function actionEstadistica()
    {
        $mascota        = new Mascota;
        $direccion      = new Direccion;
        $isla           = new Islas;
        $islas          = Islas::find()->asArray()->all();
        $especies       = new Especies;
        $tipo_especies  = Estatus::find()->asArray()->where(['id_padre' => 1])->all();
        $sexo           = Estatus::find()->asArray()->where(['id_padre' => 7])->all();
        $calle          = Calle::find()->asArray()->all();
        $procedencia    = Procedencia::find()->asArray()->all();
        $selec          = Estatus::find()->asArray()->where(['id_padre' => 4])->all();
        $discapacidad   = new Discapacidad;
        $tratamiento    = new Tratamiento;

        return $this->render('reporte',[
            'mascota'		=> $mascota,
			'isla'			=> $isla,
			'islas'			=> $islas,
			'especies'		=> $especies,
			'tipo_especies'	=> $tipo_especies,
			'sexo'			=> $sexo,
			'direccion'		=> $direccion,
            'calle'         => $calle,
			'procedencia'	=> $procedencia,
			'selec'			=> $selec,
			'discapacidad'	=> $discapacidad,
			'tratamiento'	=> $tratamiento
        ]);
    }

    /**
     * Lists all Mascota models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Mascota::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Mascota model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Mascota model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $propietario    = new Propietario;
        $mascota        = new Mascota;
        $isla           = new Islas;
        $islas          = Islas::find()->asArray()->all();
        $especies       = new Especies;
        $tipo_especies  = Estatus::find()->asArray()->where(['id_padre' => 1])->all();
        $sexo           = Estatus::find()->asArray()->where(['id_padre' => 7])->all();
        $direccion      = new Direccion;
        $calle          = Calle::find()->asArray()->all();
        $procedencia    = Procedencia::find()->asArray()->all();
        $selec          = Estatus::find()->asArray()->where(['id_padre' => 4])->all();
        $discapacidad   = new Discapacidad;
        $tratamiento    = new Tratamiento;

        //$propietario->attributes = Yii::$app->request->post('Propietario');
        if (
            $propietario->load(Yii::$app->request->post()) &&// poblar los atributos del modelo desde la entrada del usuario
            $direccion->load(Yii::$app->request->post()) &&
            $especies->load(Yii::$app->request->post()) &&
            $mascota->load(Yii::$app->request->post()) &&
            $discapacidad->load(Yii::$app->request->post()) &&
            $tratamiento->load(Yii::$app->request->post())
        ) {
            //echo "<pre>";var_dump($_POST);die;

            if (
                $propietario->validate() &&
                $direccion->validate() &&
                $especies->validate() &&
                $mascota->validate() &&
                $discapacidad->validate() &&
                $tratamiento->validate()
            ) {
                $propietario = $propietario->registrar();
                if ( $propietario ){
                    $direccion = $direccion->registrar($propietario->idpropietario);
                    if ( $direccion ) {
                        $especies = $especies->registrar();
                        if ( $especies ) {
                            $mascota = $mascota->registrar($especies->idtipo,$propietario->idpropietario);
                            if ( $mascota ) {
                                $discapacidad = $discapacidad->registrar($mascota->idmascota);
                                if ( $discapacidad ) {
                                    $tratamiento = $tratamiento->registrar($mascota->idmascota);
                                    //echo "<pre>";var_dump($tratamiento);die;
                                    if ( $tratamiento ) {
                                        Yii::$app->session->setFlash('success', '¡Se ha registrado una Mascota!');
                                        return $this->redirect(['view', 'id' => $mascota->idmascota]);
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

        return $this->render('create', [
            'propietario'   => $propietario,
            'mascota'		=> $mascota,
			'isla'			=> $isla,
			'islas'			=> $islas,
			'especies'		=> $especies,
			'tipo_especies'	=> $tipo_especies,
			'sexo'			=> $sexo,
			'direccion'		=> $direccion,
            'calle'         => $calle,
			'procedencia'	=> $procedencia,
			'selec'			=> $selec,
			'discapacidad'	=> $discapacidad,
			'tratamiento'	=> $tratamiento
        ]);
    }

    /**
     * Updates an existing Mascota model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idmasc]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Mascota model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Mascota model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Mascota the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Mascota::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
