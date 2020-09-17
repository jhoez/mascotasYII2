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

        if (Yii::$app->request->post()) {
            $query = new Query;
            $query ->select([
                'regmasc.islas.nombre as nombisla',
                'carnet.calle.nombre as nombre_calle',
                'regmasc.mascota.nombre as nombre_mascota',
                'sexo.nombre as sexo_mascota',
                'regmasc.mascota.edad as anio_mascota',
                'regmasc.procedencia.nombre as procedencia_mascota',
                'regmasc.especies.raza as raza_mascota',
                'regmasc.especies.color as color_mascota',
                'vacuna.nombre as vacunado_mascota',
                'despa.nombre as esta_desparacitado',
                'disc.nombre as tiene_discapacidad',
                'disca.nombre as discanimal',
                'tra.nombre as tiene_trataramiento',
                'trata.nombre as tratanimal',
                'este.nombre as estere'
            ])
            ->from('regmasc.mascota');
            $query->join(
                'INNER JOIN',
                'regmasc.propietario',
                'regmasc.propietario.idpropietario = regmasc.mascota.idpropietario'
            );
            $query->join(
                'INNER JOIN',
                'regmasc.direccion',
                'regmasc.direccion.idpropietario = regmasc.propietario.idpropietario'
            );
            $query->join(
                'INNER JOIN',
                'regmasc.islas',
                'regmasc.islas.idislas = regmasc.direccion.idislas'
            );
            $query->join(
                'INNER JOIN',
                'carnet.calle',
                'carnet.calle.id = regmasc.direccion.id_calle'
            );
            $query->join(
                'INNER JOIN',
                'regmasc.especies',
                'regmasc.especies.idespecies = regmasc.mascota.idespecies'
            );
            $query->join(
                'INNER JOIN',
                'regmasc.estatus as sexo',
                'sexo.idestatus = regmasc.mascota.sexo'
            );
            $query->join(
                'INNER JOIN',
                'regmasc.procedencia',
                'regmasc.procedencia.idprocedencia = regmasc.mascota.idprocedencia'
            );
            $query->join(
                'INNER JOIN',
                'regmasc.estatus as vacuna',
                'vacuna.idestatus = regmasc.mascota.vacuna_antirab'
            );
            $query->join(
                'INNER JOIN',
                'regmasc.estatus as despa',
                'despa.idestatus = regmasc.mascota.desparacitado'
            );
            $query->join(
                'INNER JOIN',
                'regmasc.estatus as disc',
                'disc.idestatus = regmasc.mascota.discapacidad'
            );
            $query->join(
                'INNER JOIN',
                'regmasc.estatus as tra',
                'tra.idestatus = regmasc.mascota.tratamiento'
            );
            $query->join(
                'INNER JOIN',
                'regmasc.estatus as este',
                'este.idestatus = regmasc.mascota.esterelizado'
            );
            $query->join(
                'INNER JOIN',
                'regmasc.discapacidad as disca',
                'disca.idmascota = regmasc.mascota.idmascota'
            );
            $query->join(
                'INNER JOIN',
                'regmasc.tratamiento as trata',
                'trata.idmascota = regmasc.mascota.idmascota'
            );

            if ( !empty($_POST['Islas']['idislas']) ){
                //$arreglopost['regmasc.direccion.idislas'] = (int)$_POST['Islas']['idislas'];
                $query->andWhere('regmasc.direccion.idislas=:idislas',[':idislas'=>(int)$_POST['Islas']['idislas']]);
            }
            if ( !empty($_POST['Direccion']['id_calle']) ){
                //$arreglopost['regmasc.direccion.id_calle'] = (int)$_POST['Direccion']['id_calle'];
                $query->andWhere('regmasc.direccion.id_calle=:id_calle',[':id_calle'=>(int)$_POST['Direccion']['id_calle']]);
            }
            if ( !empty($_POST['Especies']['idtipo']) ){
                //$arreglopost['regmasc.especies.idtipo'] = (int)$_POST['Especies']['idtipo'];
                $query->andWhere('regmasc.especies.idtipo=:idtipo',[':idtipo'=>(int)$_POST['Especies']['idtipo']]);
            }
            if ( !empty($_POST['Mascota']['sexo']) ){
                //$arreglopost['regmasc.mascota.sexo'] = (int)$_POST['Mascota']['sexo'];
                $query->andWhere('regmasc.mascota.sexo=:sexo',[':sexo'=>(int)$_POST['Mascota']['sexo']]);
            }
            if ( !empty($_POST['Mascota']['idprocedencia']) ){
                //$arreglopost['regmasc.mascota.idprocedencia'] = (int)$_POST['Mascota']['idprocedencia'];
                $query->andWhere('regmasc.mascota.idprocedencia=:idprocedencia',[':idprocedencia'=>(int)$_POST['Mascota']['idprocedencia']]);
            }
            if ( !empty($_POST['Mascota']['vacuna_antirab']) ){
                //$arreglopost['regmasc.mascota.vacuna_antirab'] = (int)$_POST['Mascota']['vacuna_antirab'];
                $query->andWhere('regmasc.mascota.vacuna_antirab=:vacuna_antirab',[':vacuna_antirab'=>(int)$_POST['Mascota']['vacuna_antirab']]);
            }
            if ( !empty($_POST['Mascota']['desparacitado']) ){
                //$arreglopost['regmasc.mascota.desparacitado'] = (int)$_POST['Mascota']['desparacitado'];
                $query->andWhere('regmasc.mascota.desparacitado=:desparacitado',[':desparacitado'=>(int)$_POST['Mascota']['desparacitado']]);
            }
            if ( !empty($_POST['Mascota']['discapacidad']) ){
                //$arreglopost['regmasc.mascota.discapacidad'] = (int)$_POST['Mascota']['discapacidad'];
                $query->andWhere('regmasc.mascota.discapacidad=:discapacidad',[':discapacidad'=>(int)$_POST['Mascota']['discapacidad']]);
            }
            if ( !empty($_POST['Mascota']['tratamiento']) ){
                //$arreglopost['regmasc.mascota.tratamiento'] = (int)$_POST['Mascota']['tratamiento'];
                $query->andWhere('regmasc.mascota.tratamiento=:tratamiento',[':tratamiento'=>(int)$_POST['Mascota']['tratamiento']]);
            }
            if ( !empty($_POST['Mascota']['esterelizado']) ){
                //$arreglopost['regmasc.mascota.esterelizado'] = (int)$_POST['Mascota']['esterelizado'];
                $query->andWhere('regmasc.mascota.esterelizado=:esterelizado',[':esterelizado'=>(int)$_POST['Mascota']['esterelizado']]);
            }

            //echo "<pre>";var_dump($_POST);die;
            //$query->where($arreglopost);
            $command = $query->createCommand();
            $mascota = $command->queryAll();
            //echo "<pre>";var_dump($command->sql,$mascota);die;

            if ($mascota) {
                $vista = $this->renderPartial('_reportePDF',['mascota'=>$mascota]);

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
                    'cssInline' => '.kv-heading-1{font-size:12px}',// any css to be embedded if required
                    //'options' => ['title' => 'Reporte de Mascota'],// set mPDF properties on the fly
                     // call mPDF methods on the fly
                    'methods' => [
                        //'SetHeader'=>['Reporte de Mascota'],
                        //'SetFooter'=>['{PAGENO}'],
                    ]
                ]);

                // return the pdf output as per the destination setting
                Yii::$app->session->setFlash('success', '¡Se ha creado el reporte!');
                $this->refresh();
                return $pdf->render();
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
        $especies       = Especies::find()->where(['idtipo'=>$mascota->idespecies])->one();
        $tipo_especies  = Estatus::find()->asArray()->where(['id_padre' => 1])->all();
        $sexo           = Estatus::find()->asArray()->where(['id_padre' => 7])->all();
        $calle          = Calle::find()->asArray()->all();
        $procedencia    = Procedencia::find()->asArray()->all();
        $selec          = Estatus::find()->asArray()->where(['id_padre' => 4])->all();
        $discapacidad   = Discapacidad::find()->where(['idmascota' => $mascota->idmascota])->one();
        $tratamiento    = Tratamiento::find()->where(['idmascota' => $mascota->idmascota])->one();

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
                //echo "<pre>";var_dump($_POST);die;
                $propietario->nombres = Html::encode($_POST['Propietario']['nombres']);
                $propietario->apellidos = Html::encode($_POST['Propietario']['apellidos']);
                $propietario->cedula = Html::encode($_POST['Propietario']['cedula']);
                $propietario->telefono = Html::encode($_POST['Propietario']['telefono']);
                $propietario->nacionalidad = Html::encode($_POST['Propietario']['nacionalidad']);
                $propietario->correo = Html::encode($_POST['Propietario']['correo']);
                if ( $propietario->update() ){
                    $direccion->idislas = Html::encode($_POST['Direccion']['idislas']);
                    $direccion->ncasa = Html::encode($_POST['Direccion']['ncasa']);
                    $direccion->id_calle = Html::encode($_POST['Direccion']['id_calle']);
                    if ( $direccion->update() ){
                        $especies->idtipo = Html::encode($_POST['Especies']['idtipo']);
                        $especies->raza = Html::encode($_POST['Especies']['raza']);
                        $especies->color = Html::encode($_POST['Especies']['color']);
                        if ( $especies->update() ) {
                            $mascota->idespecies = $especies->idespecies;
                            $mascota->idprocedencia = Html::encode($_POST['Mascota']['idprocedencia']);
                            $mascota->idpropietario = $propietario->idpropietario;
                            $mascota->nombre = Html::encode($_POST['Mascota']['nombre']);
                            $mascota->sexo = Html::encode($_POST['Mascota']['sexo']);
                            $mascota->edad = Html::encode($_POST['Mascota']['edad']);
                            $mascota->vacuna_antirab = Html::encode($_POST['Mascota']['vacuna_antirab']);
                            $mascota->desparacitado = Html::encode($_POST['Mascota']['desparacitado']);
                            $mascota->discapacidad = Html::encode($_POST['Mascota']['discapacidad']);
                            $mascota->tratamiento = Html::encode($_POST['Mascota']['tratamiento']);
                            $mascota->esterelizado = Html::encode($_POST['Mascota']['esterelizado']);
                            if ( $mascota->update() ) {
                                $discapacidad->nombre = Html::encode($_POST['Discapacidad']['nombre']);
                                if ( $discapacidad->update() ) {
                                    $tratamiento->nombre = Html::encode($_POST['Tratamiento']['nombre']);
                                    if ( $tratamiento->update() ) {
                                        Yii::$app->session->setFlash('success', '¡Se ha Actualizado una Mascota!');
                                        return $this->redirect(['view', 'id' => $mascota->idmascota]);
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

        return $this->render('update', [
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
