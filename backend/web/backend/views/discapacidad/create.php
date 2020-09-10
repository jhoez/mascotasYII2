<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Discapacidad */

$this->title = 'Create Discapacidad';
$this->params['breadcrumbs'][] = ['label' => 'Discapacidads', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="discapacidad-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
