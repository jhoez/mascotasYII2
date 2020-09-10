<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\MascotaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mascota-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idmascota') ?>

    <?= $form->field($model, 'idespecies') ?>

    <?= $form->field($model, 'idprocedencia') ?>

    <?= $form->field($model, 'idpropietario') ?>

    <?= $form->field($model, 'nombre') ?>

    <?php // echo $form->field($model, 'sexo') ?>

    <?php // echo $form->field($model, 'edad') ?>

    <?php // echo $form->field($model, 'vacuna_antirab') ?>

    <?php // echo $form->field($model, 'desparacitado') ?>

    <?php // echo $form->field($model, 'discapacidad') ?>

    <?php // echo $form->field($model, 'tratamiento') ?>

    <?php // echo $form->field($model, 'esterelizado') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
