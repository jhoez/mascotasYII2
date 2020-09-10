<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Procedencia */

$this->title = 'Update Procedencia: ' . $model->idprocedencia;
$this->params['breadcrumbs'][] = ['label' => 'Procedencias', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idprocedencia, 'url' => ['view', 'id' => $model->idprocedencia]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="procedencia-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
