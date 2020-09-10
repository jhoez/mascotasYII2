<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Tratamiento */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tratamiento-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idmascota')->textInput() ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
