<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Especies */

$this->title = 'Update Especies: ' . $model->idespecies;
$this->params['breadcrumbs'][] = ['label' => 'Especies', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idespecies, 'url' => ['view', 'id' => $model->idespecies]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="especies-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
