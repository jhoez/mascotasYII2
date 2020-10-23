<?php

namespace frontend\controllers;

use Yii;
use yii\db\Query;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\models\Usuario;
use frontend\models\Mascota;
use frontend\models\MascotaSearch;
use frontend\models\Direccion;
use frontend\models\Discapacidad;
use frontend\models\Especies;
use frontend\models\Estatus;
use frontend\models\Islas;
use frontend\models\Procedencia;
use frontend\models\Propietario;
use frontend\models\Tratamiento;
use frontend\models\Calle;
use kartik\mpdf\Pdf;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\Response;

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
                        'actions' => [
                            'index','view','logout','create','reportes','update','delete'
                        ],
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
    public function actionReportes()
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

        if (
            $isla->load(Yii::$app->request->post()) &&// poblar los atributos del modelo desde la entrada del usuario
            $direccion->load(Yii::$app->request->post()) &&
            $especies->load(Yii::$app->request->post()) &&
            $mascota->load(Yii::$app->request->post())
        ) {

            $masc = Mascota::find()
                    ->innerJoinWith(['tipomascota'])
                    ->innerJoinWith(['sexo'])
                    ->innerJoinWith(['estavacunado'])
                    ->innerJoinWith(['estadesparacitado'])
                    ->innerJoinWith(['tienediscapacidad'])
                    ->innerJoinWith(['tienetratamiento'])
                    ->innerJoinWith(['esterelizado'])
                    ->innerJoinWith(['idprocedencia']);
            if ( !empty($isla->idislas) ){
                $proislas = Direccion::find()
                            ->select(['idpropietario'])
                            ->asArray()
                            ->where(['idislas'=>(int)Yii::$app->request->post('Islas')['idislas'] ])
                            ->all();
                $masc->andWhere(['in','idpropietario',$proislas]);
            }
            if ( !empty($direccion->id_calle) ){
                $procalle = Direccion::find()
                            ->select(['idpropietario'])
                            ->asArray()
                            ->where(['id_calle'=>(int)Yii::$app->request->post('Direccion')['id_calle'] ])
                            ->all();
                $masc->andWhere(['in','idpropietario',$procalle]);
            }
            if ( !empty($especies->idtipo) ){
                $masc->andWhere(['idtipo'=>$especies->idtipo]);
            }
            if ( !empty($mascota->sexo) ){
                $masc->andWhere(['sexo'=>$mascota->sexo]);
            }
            if ( !empty($mascota->idpropietario) ){
                $masc->andWhere(['idprocedencia'=>$mascota->idpropietario]);
            }
            if ( !empty($mascota->statusvacunado) ){
                $masc->andWhere(['statusvacunado'=>$mascota->statusvacunado]);
            }
            if ( !empty($mascota->statusdesparacitado) ){
                $masc->andWhere(['statusdesparacitado'=>$mascota->statusdesparacitado]);
            }
            if ( !empty($mascota->statusdiscapacidad) ){
                $masc->andWhere(['statusdiscapacidad'=>$mascota->statusdiscapacidad]);
            }
            if ( !empty($mascota->statustratamiento) ){
                $masc->andWhere(['statustratamiento'=>$mascota->statustratamiento]);
            }
            if ( !empty($mascota->statusesterilizado) ){
                $masc->andWhere(['statusesterilizado'=>$mascota->statusesterilizado]);
            }
            $dataProvider = new ActiveDataProvider([
                'query' => $masc
            ]);
            $result = $dataProvider->query->all();

            if (is_array($result)) {
                $vista = $this->renderPartial('_reportePDF',['mascota'=>$result]);

                $pdf = new Pdf([
                    'mode' => Pdf::MODE_CORE,// set to use core fonts only
                    'format' => Pdf::FORMAT_A4,// A4 paper format
                    'orientation' => Pdf::ORIENT_PORTRAIT,// portrait orientation
                    'destination' => Pdf::DEST_DOWNLOAD,// stream to browser inline
                    'content' => $vista,// your html content input
                    'filename'=> 'ReporteMascota-'.date('Y-m-d h:i:s',time()).'.pdf',
                    // format content from your own css file if needed or use the
                    // enhanced bootstrap css built by Krajee for mPDF formatting
                    'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
                    'cssInline' => '.kv-heading-1{font-size:12px};',// any css to be embedded if required
                    //'options' => ['title' => 'Reporte de Mascota'],// set mPDF properties on the fly
                     // call mPDF methods on the fly
                    'methods' => [
                        //'SetHeader'=>['Reporte de Mascota'],
                        //'SetFooter'=>['{PAGENO}'],
                    ]
                ]);

                // return the pdf output as per the destination setting
                Yii::$app->session->setFlash('success', '¡Se ha creado el reporte!');
                return $pdf->render();
                $this->refresh();
            }else {
                Yii::$app->session->setFlash('warning', '¡No coinciden los datos que solicita!');
            }
        }

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
        $searchModel = new MascotaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

        /*
        // no agrega el filtro de busqueda
        $dataProvider = new ActiveDataProvider([
            'query' => Mascota::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);*/
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

        if ($mascota->load(Yii::$app->request->post()) && Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($mascota);
        }

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
                //verificar si existe el propietario y mandar el idpropietario
                $prop = Propietario::find()->where(['cedula'=>$propietario->cedula])->one();
                if (isset($prop)) {
                    $propietario = $prop;
                }else{
                    $propietario = $propietario->registrar();
                }

                if ( $propietario ){
                    $direccion = $direccion->registrar($propietario->idpropietario);
                    if ( $direccion ) {
                        $especies = $especies->registrar();
                        if ( $especies ) {
                            $mascota = $mascota->registrar($especies->idespecies,$propietario->idpropietario);
                            if ( $mascota ) {
                                $discapacidad = $discapacidad->registrar($mascota->idmascota);
                                if ( $discapacidad ) {
                                    $tratamiento = $tratamiento->registrar($mascota->idmascota);
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
        $mascota        = $this->findModel($id);
        $propietario    = Propietario::find()->where(['idpropietario'=>$mascota->idpropietario])->one();
        $direccion      = Direccion::find()->where(['idpropietario'=>$propietario->idpropietario])->one();
        $islas          = Islas::find()->asArray()->all();
        $especies       = Especies::find()->where(['idespecies'=>$mascota->idespecies])->one();
        $tipo_especies  = Estatus::find()->asArray()->where(['id_padre' => 1])->all();
        $sexo           = Estatus::find()->asArray()->where(['id_padre' => 7])->all();
        $calle          = Calle::find()->asArray()->all();
        $procedencia    = Procedencia::find()->asArray()->all();
        $selec          = Estatus::find()->asArray()->where(['id_padre' => 4])->all();
        $discapacidad   = Discapacidad::find()->where(['idmascota' => $mascota->idmascota])->one();
        $tratamiento    = Tratamiento::find()->where(['idmascota' => $mascota->idmascota])->one();

        //$propietario->attributes = Yii::$app->request->post('Propietario');
        if (
            $propietario->load(Yii::$app->request->post()) &&
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
                $propietario = $propietario->actualizar();
                if ( is_object($propietario) ){
                    $direccion = $direccion->actualizar();
                    if ( is_object($direccion) ){
                        $especies = $especies->actualizar();
                        if ( is_object($especies) ) {
                            $mascota = $mascota->actualizar();
                            if ( is_object($mascota) ) {
                                $discapacidad = $discapacidad->actualizar();
                                if ( is_object($discapacidad) ) {
                                    $tratamiento = $tratamiento->actualizar();
                                    if ( is_object($tratamiento) ) {
                                        Yii::$app->session->setFlash('success', '¡Se ha Actualizado el registro!');
                                        return $this->redirect(['view', 'id' => $mascota->idmascota]);
                                    }
                                }
                            }
                        }
                    }
                }

            }//end if
        }

        return $this->render('update', [
            'propietario'   => $propietario,
            'mascota'       => $mascota,
            'islas'         => $islas,
            'especies'      => $especies,
            'tipo_especies' => $tipo_especies,
            'sexo'          => $sexo,
            'direccion'     => $direccion,
            'calle'         => $calle,
            'procedencia'   => $procedencia,
            'selec'         => $selec,
            'discapacidad'  => $discapacidad,
            'tratamiento'   => $tratamiento
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
        $mascota        = $this->findModel($id);
        $tratamiento    = Tratamiento::findOne(['idmascota'=>$mascota->idmascota]);
        $discapacidad   = Discapacidad::findOne(['idmascota'=>$mascota->idmascota]);
        $especies       = Especies::findOne(['idespecies'=>$mascota->idespecies]);
        $propietario    = Propietario::findOne(['idpropietario'=>$mascota->idpropietario]);
        $direccion      = Direccion::findOne(['idpropietario'=>$propietario->idpropietario]);

        $tratamiento->delete();
        $discapacidad->delete();
        $mascota->delete();
        $especies->delete();
        $direccion->delete();
        $propietario->delete();

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
