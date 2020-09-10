<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\DiscapacidadSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Discapacidads';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="discapacidad-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Discapacidad', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'iddiscapacidad',
            'idmascota',
            'nombre',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
