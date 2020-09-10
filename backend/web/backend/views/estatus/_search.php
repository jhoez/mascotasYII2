<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\EstatusSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="estatus-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idestatus') ?>

    <?= $form->field($model, 'id_padre') ?>

    <?= $form->field($model, 'nombre') ?>

    <?= $form->field($model, 'cant_hijos') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>