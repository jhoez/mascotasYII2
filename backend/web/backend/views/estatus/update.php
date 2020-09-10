<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Estatus */

$this->title = 'Update Estatus: ' . $model->idestatus;
$this->params['breadcrumbs'][] = ['label' => 'Estatuses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idestatus, 'url' => ['view', 'id' => $model->idestatus]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="estatus-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
