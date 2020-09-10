<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Islas */

$this->title = 'Crear Isla';
$this->params['breadcrumbs'][] = ['label' => 'Islas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="islas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'islas' => $islas,
    ]) ?>

</div>
