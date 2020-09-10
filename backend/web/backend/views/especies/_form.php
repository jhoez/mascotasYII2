<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Especies */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="especies-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idtipo')->textInput() ?>

    <?= $form->field($model, 'raza')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'color')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
