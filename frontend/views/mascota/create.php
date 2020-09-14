<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Mascota */

$this->title = 'Crear Mascota';
$this->params['breadcrumbs'][] = ['label' => 'Mascotas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mascota-create">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('Registros de Mascota', ['index'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Estadistica', ['estadistica'], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= $this->render('_form', [
        'propietario'   => $propietario,
        'mascota'		=> $mascota,
        'islas'			=> $islas,
        'especies'		=> $especies,
        'tipo_especies'	=> $tipo_especies,
        'sexo'			=> $sexo,
        'direccion'		=> $direccion,
        'calle'         => $calle,
        'procedencia'	=> $procedencia,
        'selec'			=> $selec,
        'discapacidad'	=> $discapacidad,
        'tratamiento'	=> $tratamiento
    ]) ?>

</div>
