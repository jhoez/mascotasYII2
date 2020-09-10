<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Islas;
use frontend\models\IslasSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * IslasController implements the CRUD actions for Islas model.
 */
class IslasController extends Controller
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
                        'actions' => ['index','create','view','update','delete'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
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
     * Lists all Islas models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new IslasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Islas model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'islas' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Islas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $islas = new Islas();

        /*if (isset($_POST)) {
            echo "<pre>";var_dump($_POST);die;
        }*/

        if ( $islas->load(Yii::$app->request->post()) ) {
            if (
                $islas->validate()
            ) {
                $islas = $islas->registrar();
                return $this->redirect(['view', 'id' => $islas->idislas]);
            }
        }

        return $this->render('create', [
            'islas' => $islas,
        ]);
    }

    /**
     * Updates an existing Islas model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $islas = $this->findModel($id);

        if ($islas->load(Yii::$app->request->post()) && $islas->save()) {
            return $this->redirect(['view', 'id' => $islas->idislas]);
        }

        return $this->render('update', [
            'model' => $islas,
        ]);
    }

    /**
     * Deletes an existing Islas model.
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
     * Finds the Islas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Islas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($islas = Islas::findOne($id)) !== null) {
            return $islas;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
