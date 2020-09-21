<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Mascota */

$this->title = 'Detalles de la mascota registrada';
$this->params['breadcrumbs'][] = ['label' => 'Mascotas', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Detalles';
\yii\web\YiiAsset::register($this);
?>
<div class="mascota-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
<<<<<<< HEAD
        <?= Html::a('Registrar Mascota', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Registros Mascota', ['index'], ['class' => 'btn btn-primary']) ?>
=======
        <?= Html::a('Actualizar', ['update', 'id' => $model->idmascota], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->idmascota], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Esta seguro de eliminar este registro?',
                'method' => 'post',
            ],
        ]) ?>
>>>>>>> de8f2512896ab5cdeea6d9077187944d22023e37
    </p>

    <div class="panel-body">
        <?= DetailView::widget([
        'model' => $model,
        /*'htmlOptions'=>[
            'class'=>'detail-view-2 table table-bordered',
        ],*/
        'attributes' => [
            [
                'label'=>'Id Mascota',
                'attribute'=>'idmascota',
                'value'=>function($data){
                    return $data->idmascota;
                },
            ],
            /*[
                'label'=>'Id propietario',
                'attribute'=>'idpropietario',
                'value'=>function($data){
                    return $data->getMascPropietario()->idpropietario;
                },
            ],
            [
                'label'=>'Id propietario mascota',
                'attribute'=>'idpropietario',
                'value'=>function($data){
                    return $data->idpropietario;
                },
            ],*/
            [
                'label'=>'Nacionalidad',
                'attribute'=>'nacionalidad',
                'value'=>function($data){
                    return $data->getMascPropietario()->nacionalidad == 'V' ? 'Venezolano' : 'Extrangero';
                },
                //'contentOptions'=>['class'=>'bg-red'],
                //'captionOptions'=>['tooltip'=>'tooltip']
            ],
            [
                'label'=>'Cedula',
                'attribute'=>'cedula',
                'value'=>function($data){
                    return $data->getMascPropietario()->cedula;
                },
            ],
            [
                'label'=>'Nombres',
                'attribute'=>'nombres',
                'value'=>function($data){
                    return $data->getMascPropietario()->nombres;
                },
            ],
            [
                'label'=>'Apellidos',
                'attribute'=>'apellidos',
                'value'=>function($data){
                    return $data->getMascPropietario()->apellidos;
                },
            ],
            [
                'label'=>'Islas - Cayos',
                'attribute'=>'nombre',
                'value'=>function($data){
                    return $data->getMascPropietario()->getProDireccion()->getDirIsla()->nombre;
                },
            ],
            [
                'label'=>'Calle',
                'attribute'=>'nombre',
                'value'=>function($data){
                    return $data->getMascPropietario()->getProDireccion()->getDirCalle()->nombre;
                },
            ],
            [
                'label'=>'N# casa',
                'attribute'=>'ncasa',
                'value'=>function($data){
                    return $data->getMascPropietario()->getProDireccion()->ncasa;
                },
            ],
            [
                'label'=>'Telefono',
                'attribute'=>'telefono',
                'value'=>function($data){
                    return $data->getMascPropietario()->telefono;
                },
            ],
            [
                'label'=>'Correo',
                'attribute'=>'correo',
                'value'=>function($data){
                    return $data->getMascPropietario()->correo;
                },
            ],
            [
                'label'=>'Nombre de la Mascota',
                'attribute'=>'nombre',
                'value'=>function($data){
                    return $data->nombre;
                },
            ],
            [
                'label'=>'Edad',
                'attribute'=>'edad',
                'value'=>function($data){
                    return $data->edad;
                },
            ],
            [
                'label'=>'Tipo de mascota',
                'attribute'=>'nombre',
                'value'=>function($data){
                    return $data->getMascTipoMascota()->getEspTipo()->nombre;
                },
            ],
            [
                'label'=>'Sexo',
                'attribute'=>'sexo',
                'value'=>function($data){
                    return $data->getMascSexo()->nombre;
                },
            ],
            [
                'label'=>'Raza',
                'attribute'=>'raza',
                'value'=>function($data){
                    return $data->getMascTipoMascota()->raza;
                },
            ],
            [
                'label'=>'Color',
                'attribute'=>'color',
                'value'=>function($data){
                    return $data->getMascTipoMascota()->color;
                },
            ],
            [
                'label'=>'Procedencia',
                'attribute'=>'nombre',
                'value'=>function($data){
                    return $data->getMascProcedencia()->nombre;
                },
            ],
            [
                'label'=>'Esta vacunado',
                'attribute' => 'vacuna_antirab',
                'value' => function($data){
                    return $data->getMascEstaVacunado()->nombre;
                }
            ],
            [
                'label'=>'Esta desparacitado',
                'attribute' => 'desparacitado',
                'value' => function($data){
                    return $data->getMascEstaDesparacitado()->nombre;
                }
            ],
            [
                'label'=>'Tiene discapacidad',
                'attribute'=>'nombre',
                'value'=> function($data){
                    return $data->getMascTieneDiscapacidad()->nombre;
                }
            ],
            [
                'label'=>'Discapacidad',
                'attribute'=>'nombre',
                'value'=> function($data){
                    return $data->getMascDiscapacidad()->nombre;
                }
            ],
            [
                'label'=>'Tiene Tratamiento',
                'attribute'=>'nombre',
                'value'=> function($data){
                    return $data->getMascTieneTratamiento()->nombre;
                }
            ],
            [
                'label'=>'Tratamiento',
                'attribute'=>'nombre',
                'value'=> function($data){
                    return $data->getMascTratamiento()->nombre;
                }
            ],
            [
                'label'=>'Esta esterilizado',
                'attribute'=>'nombre',
                'value'=> function($data){
                    return $data->getMascEstaEsterelizado()->nombre;
                }
            ],
        ],
        ]) ?>
    </div>

</div>
