<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $mascota app\models\Mascota */

$this->title = 'Update Mascota: ' . $mascota->idmascota;
$this->params['breadcrumbs'][] = ['label' => 'Mascotas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $mascota->idmascota, 'url' => ['view', 'id' => $mascota->idmascota]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mascota-update">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('Registrar Mascota', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Reportes', ['reportesPE'], ['class' => 'btn btn-primary']) ?>
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
