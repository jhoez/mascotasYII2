<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Mascota */

$this->title = 'Create Mascota';
$this->params['breadcrumbs'][] = ['label' => 'Mascotas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mascota-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
