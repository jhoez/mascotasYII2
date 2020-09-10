<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\EstatusSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Estatuses';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estatus-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Estatus', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idestatus',
            'id_padre',
            'nombre',
            'cant_hijos',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
