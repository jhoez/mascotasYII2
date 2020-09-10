<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mascotas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mascota-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Mascota', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Estadistica', ['estadistica'], ['class' => 'btn btn-primary']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'idmascota',
            'nombre',
            'edad',
            'sexo',
            [
                'class' => 'yii\grid\ActionColumn',
                'header'=>'Action',
                'headerOptions'=>['width'=>'80'],
                'template'=>'{view}{update}{delete}',
                'buttons'=> [
                    'view' => function($url,$mascota){
                        return Html::a(
                            '<span class="glyphicon glyphicon-user"></span>',
                            "/mascota/view/$mascota->idmascota"
                        );
                    },
                    'update' => function(){
                    },
                    'delete' => function(){
                    },
                ],
            ],
        ],
    ]); ?>


</div>
