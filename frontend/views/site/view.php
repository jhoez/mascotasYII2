<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Mascota */

$this->title = 'Detalles de la mascota registrada';
$this->params['breadcrumbs'][] = ['label' => 'Home', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Detalles';
\yii\web\YiiAsset::register($this);
?>
<div class="site-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->idmascota], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->idmascota], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="panel-body">
        <?= DetailView::widget([
        'model' => $model,
        /*'htmlOptions'=>[
            'class'=>'detail-view-2 table table-bordered',
        ],*/
        'attributes' => [
            'idmascota',
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
                //'contentOptions'=>['class'=>'bg-red'],
                //'captionOptions'=>['tooltip'=>'tooltip']
            ],
            [
                'label'=>'Nombres',
                'attribute'=>'nombres',
                'value'=>function($data){
                    return $data->getMascPropietario()->nombres;
                },
                //'contentOptions'=>['class'=>'bg-red'],
                //'captionOptions'=>['tooltip'=>'tooltip']
            ],
            [
                'label'=>'Apellidos',
                'attribute'=>'apellidos',
                'value'=>function($data){
                    return $data->getMascPropietario()->apellidos;
                },
                //'contentOptions'=>['class'=>'bg-red'],
                //'captionOptions'=>['tooltip'=>'tooltip']
            ],
            [
                'label'=>'Islas - Cayos',
                'attribute'=>'nombre',
                'value'=>function($data){
                    return $data->getMascPropietario()->getProDireccion()->getDirIsla()->nombre;
                },
                //'contentOptions'=>['class'=>'bg-red'],
                //'captionOptions'=>['tooltip'=>'tooltip']
            ],
            [
                'label'=>'Calle',
                'attribute'=>'nombre',
                'value'=>function($data){
                    return $data->getMascPropietario()->getProDireccion()->getDirCalle()->nombre;
                },
                //'contentOptions'=>['class'=>'bg-red'],
                //'captionOptions'=>['tooltip'=>'tooltip']
            ],
            [
                'label'=>'N# casa',
                'attribute'=>'ncasa',
                'value'=>function($data){
                    return $data->getMascPropietario()->getProDireccion()->ncasa;
                },
                //'contentOptions'=>['class'=>'bg-red'],
                //'captionOptions'=>['tooltip'=>'tooltip']
            ],
            [
                'label'=>'Telefono',
                'attribute'=>'telefono',
                'value'=>function($data){
                    return $data->getMascPropietario()->telefono;
                },
                //'contentOptions'=>['class'=>'bg-red'],
                //'captionOptions'=>['tooltip'=>'tooltip']
            ],
            [
                'label'=>'Correo',
                'attribute'=>'correo',
                'value'=>function($data){
                    return $data->getMascPropietario()->correo;
                },
                //'contentOptions'=>['class'=>'bg-red'],
                //'captionOptions'=>['tooltip'=>'tooltip']
            ],
            [
                'label'=>'Nombre de la Mascota',
                'attribute'=>'nombre',
                'value'=>'nombre',
                //'contentOptions'=>['class'=>'bg-red'],
                //'captionOptions'=>['tooltip'=>'tooltip']
            ],
            [
                'label'=>'Edad',
                'attribute'=>'edad',
                'value'=>function($data){
                    return $data->edad;
                },
                //'contentOptions'=>['class'=>'bg-red'],
                //'captionOptions'=>['tooltip'=>'tooltip']
            ],
            [
                'label'=>'Sexo',
                'attribute'=>'sexo',
                'value'=>function($data){
                    return $data->getMascSexo()->nombre;
                },
                //'contentOptions'=>['class'=>'bg-red'],
                //'captionOptions'=>['tooltip'=>'tooltip']
            ],
            [
                'label'=>'Tipo de mascota',
                'attribute'=>'nombre',
                'value'=>function($data){
                    return $data->getMascTipoMascota()->getEspTipo()->nombre;
                },
                //'contentOptions'=>['class'=>'bg-red'],
                //'captionOptions'=>['tooltip'=>'tooltip']
            ],
            [
                'label'=>'Procedencia',
                'attribute'=>'nombre',
                'value'=>function($data){
                    return $data->getMascProcedencia()->nombre;
                },
                //'contentOptions'=>['class'=>'bg-red'],
                //'captionOptions'=>['tooltip'=>'tooltip']
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
