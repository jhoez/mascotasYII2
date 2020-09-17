<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use frontend\models\Mascota;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mascotas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mascota-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('Registrar Mascota', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Reportes', ['reportes'], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            /*[
                'header'=>'ID',
                'attribute' => 'idmascota',
                'value' => 'idmascota',
                'filter'=>false
            ],*/
            [
                'header'=>'Cedula',
                'attribute' => 'cedula',
                'value' => 'idpropietario.cedula',
            ],
            [
                'label'=>'Nombre',
                'attribute' => 'nombre',
                'value' => 'nombre',
            ],
            [
                'header'=>'Edad',
                'attribute' => 'edad',
                'value' => 'edad'
            ],
            [
                'header'=>'Sexo',
                'attribute' => 'sexo',
                'value' => function($data){
                    return $data->getMascSexo()->nombre;
                }
            ],
            [
                'header'=>'Tipo de Mascota',
                'attribute' => 'sexo',
                'value' => function($data){
                    return $data->getMascTipoMascota()->getEspTipo()->nombre;
                }
            ],
            [
                'header'=>'Esta vacunado',
                'attribute' => 'vacuna_antirab',
                'value' => function($data){
                    return $data->getMascEstaVacunado()->nombre;
                }
            ],
            [
                'header'=>'Esta desparacitado',
                'attribute' => 'desparacitado',
                'value' => function($data){
                    return $data->getMascEstaDesparacitado()->nombre;
                }
            ],
            [
                'header'=>'Tiene discapacidad',
                'attribute'=>'discapacidad',
                'value'=> function($data){
                    return $data->getMascTieneDiscapacidad()->nombre;
                }
            ],
            [
                'header'=>'Discapacidad',
                'attribute'=>'nombre',
                'value'=> function($data){
                    return $data->getMascDiscapacidad()->nombre;
                }
            ],
            [
                'header'=>'Tiene Tratamiento',
                'attribute'=>'tratamiento',
                'value'=> function($data){
                    return $data->getMascTieneTratamiento()->nombre;
                }
            ],
            [
                'header'=>'Tratamiento',
                'attribute'=>'nombre',
                'value'=> function($data){
                    return $data->getMascTratamiento()->nombre;
                }
            ],
            [
                'header'=>'Esta esterilizado',
                'attribute'=>'esterelizado',
                'value'=> function($data){
                    return $data->getMascEstaEsterelizado()->nombre;
                }
            ],
            /*
            [
                'label'  => 'Image',
                'format' => 'raw',
                'value'  => function ($data) {
                    $url = "/images/products/" . $data['image'];

                    return Html::img($url, ['alt' => $data['name'], 'height' => 50]);
                },
],
            */
            [
                'class' => 'yii\grid\ActionColumn',
                'header'=>'Action',
                'headerOptions'=>['width'=>'80'],
                'template'=>'{view}{update}{delete}',
                'buttons'=> [
                    'view' => function($data){
                        return Html::a(
                            '<span class="glyphicon glyphicon-eye-open"></span>',
                            $data
                        );
                    },
                    'update' => function($data){
                        return Html::a(
                            '<span class="glyphicon glyphicon-pencil"></span>',
                            $data
                        );
                    },
                    'delete' => function($data){
                        return Html::a(
                            '<span class="glyphicon glyphicon-remove"></span>',
                            $data
                        );
                    },
                ],
            ],
        ],
    ]); ?>


</div>

<?php
/*
'download' => function ($url, $model) {
       return Html::a(
           '<span class="glyphicon glyphicon-arrow-download"></span>',
           ['another-controller/anotner-action', 'id' => $model->id],
           [
               'title' => 'Download',
               'data-pjax' => '0',
           ]
       );
},


filtro de campo

[
               'attribute' => 'permiso_estatus_id', // Debe llamarse igual a la llave foránea
               'value' => 'permisoEstatus.nombre', // Se deberá de colocar el nombre del campo con el cual se filtrará, puede usarse el mismo nombre de acuerdo al modelo
               'filterType' => GridView::FILTER_SELECT2, //No cambia dejarlo tal cual
               'filter' => ArrayHelper::map($permisoStatus, 'id', 'nombre'), //Se debe de mapear el arreglo
               'filterWidgetOptions' =>[
                   'pluginOptions' => [ 'allowClear' => true ],
               ],
               'filterInputOptions' => [ 'placeholder' =>  'Estatus Solicitud' ], // Si así lo desea puedes agregar un place holder
           ],
*/
?>
