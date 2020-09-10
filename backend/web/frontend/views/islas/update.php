<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Islas */

$this->title = 'Update Islas: ' . $model->idislas;
$this->params['breadcrumbs'][] = ['label' => 'Islas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idislas, 'url' => ['view', 'id' => $model->idislas]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="islas-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
