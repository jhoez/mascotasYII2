<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Discapacidad */

$this->title = 'Update Discapacidad: ' . $model->iddiscapacidad;
$this->params['breadcrumbs'][] = ['label' => 'Discapacidads', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->iddiscapacidad, 'url' => ['view', 'id' => $model->iddiscapacidad]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="discapacidad-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
