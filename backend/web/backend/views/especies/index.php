<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\EspeciesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Especies';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="especies-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Especies', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idespecies',
            'idtipo',
            'raza',
            'color',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
