<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Mascota */

$this->title = 'Update Mascota: ' . $model->idmasc;
$this->params['breadcrumbs'][] = ['label' => 'Mascotas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idmasc, 'url' => ['view', 'id' => $model->idmasc]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mascota-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>