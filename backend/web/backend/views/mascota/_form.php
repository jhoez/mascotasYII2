<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Mascota */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mascota-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idespecies')->textInput() ?>

    <?= $form->field($model, 'idprocedencia')->textInput() ?>

    <?= $form->field($model, 'idpropietario')->textInput() ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sexo')->textInput() ?>

    <?= $form->field($model, 'edad')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'vacuna_antirab')->textInput() ?>

    <?= $form->field($model, 'desparacitado')->textInput() ?>

    <?= $form->field($model, 'discapacidad')->textInput() ?>

    <?= $form->field($model, 'tratamiento')->textInput() ?>

    <?= $form->field($model, 'esterelizado')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
