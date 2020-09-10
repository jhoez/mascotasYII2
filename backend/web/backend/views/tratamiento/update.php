<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Tratamiento */

$this->title = 'Update Tratamiento: ' . $model->idtratamiento;
$this->params['breadcrumbs'][] = ['label' => 'Tratamientos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idtratamiento, 'url' => ['view', 'id' => $model->idtratamiento]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tratamiento-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
