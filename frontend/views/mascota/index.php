<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\jui\DatePicker;
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
            ['class' => 'yii\grid\SerialColumn'],
            [
                'label'=>'fecha',
                'attribute' => 'created_at',
                'value' => function($data){
                    return $data->created_at;
                },
            ],
            [
                'label'=>'Nombre',
                'attribute' => 'nombre',
                'value' => function($data){
                    return $data->nombre;
                },
            ],
            [
                'label'=>'Edad',
                'attribute' => 'edad',
                'value' => function($data){
                    return $data->edad;
                }
            ],
            [
                'label'=>'Sexo',
                'attribute' => 'sexo',
                'filter'=>['8'=>'Macho','9'=>'Hembra'],
                'value' => function($data){
                    return $data->sexo == '8' ? 'Macho' : 'Hembra';
                }
            ],
            [
                'label'=>'Tipo de Mascota',
                'attribute' => 'idtipo',
                'filter'=>['2'=>'Perro','3'=>'Gato'],
                'value' => function($data){
                    return $data->getMascTipoMascota()->idtipo == '2' ? 'Perro' : 'Gato';
                }
            ],
            [
                'label'=>'Esta vacunado',
                'attribute' => 'statusvacunado',
                'filter'=>['5'=>'Si','6'=>'No'],
                'value' => function($data){
                    return $data->statusvacunado == '5' ? 'Si' : 'No';
                }
            ],
            [
                'label'=>'Esta desparacitado',
                'attribute' => 'statusdesparacitado',
                'filter'=>['5'=>'Si','6'=>'No'],
                'value' => function($data){
                    return $data->statusdesparacitado == '5' ? 'Si' : 'No';
                }
            ],
            [
                'label'=>'Tiene discapacidad',
                'attribute'=>'statusdiscapacidad',
                'filter'=>['5'=>'Si','6'=>'No'],
                'value'=> function($data){
                    return $data->statusdiscapacidad == '5' ? 'Si' : 'No';
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
                'attribute'=>'statustratamiento',
                'filter'=>['5'=>'Si','6'=>'No'],
                'value'=> function($data){
                    return $data->statustratamiento == '5' ? 'Si' : 'No';
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
                'attribute'=>'statusesterilizado',
                'filter'=>['5'=>'Si','6'=>'No'],
                'value'=> function($data){
                    return $data->statusesterilizado == '5' ? 'Si' : 'No';
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
