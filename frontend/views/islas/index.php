<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\IslasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Islas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="islas-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Crear Isla', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'idislas',
            'nombre',
            [
                'class' => 'yii\grid\ActionColumn',
                'header'=>'Action',
                'headerOptions'=>['width'=>'80'],
                'template'=>'{view}{update}{delete}',
                'buttons'=> [
                    'view' => function(){
                        return Html::a(
                            '<span class="glyphicon glyphicon-"></span>',
                            "/mascota/view/"
                        );
                    },
                    'update' => function(){
                        return Html::a(
                            '<span class="glyphicon glyphicon-edit"></span>',
                            "/mascota/view/"
                        );
                    },
                    'delete' => function(){
                        return Html::a(
                            '<span class="glyphicon glyphicon-"></span>',
                            "/mascota/view/"
                        );
                    },
                ],
            ],
        ],
    ]); ?>


</div>
