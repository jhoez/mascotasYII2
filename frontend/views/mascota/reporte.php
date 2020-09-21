<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

$this->title = 'Reportes de Mascotas';
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

?>

<h1><?= Html::encode($this->title) ?></h1>
<p>
    <?= Html::a('Registrar Mascota', ['create'], ['class' => 'btn btn-primary']) ?>
</p>

<div class="row clearfix">
    <div class="col-md-offset-2 col-md-8 col-md-offset-2">
        <div class="registro-form">
            <?php $form = ActiveForm::begin(); ?>

            <div class="form-group">
                <?= Html::label('Islas - Cayos', 'idislas', ['class' => ''])?>
                <div class="">
                    <?= Html::activeDropDownList(
                        $isla,'idislas',
                        ArrayHelper::map($islas, 'idislas', 'nombre'),
                        ['prompt' => '---- Seleccione ----','class' => 'form-control imput-md']
                    )?>
                </div>
            </div>
            <div class="form-group">
                <?= Html::label('Calle', 'id_calle', ['class' => ''])?>
                <div class="">
                    <?= Html::activeDropDownList(
                        $direccion, 'id_calle',
                        ArrayHelper::map($calle,'id','nombre'),
                        ['prompt'=>'---- Seleccione ----','class' => 'form-control imput-md']
                    )?>
                </div>
            </div>
            <div class="form-group">
                <?= Html::label('Tipo de mascota', 'idtipo', ['class' => ''])?>
                <div class="">
                    <?= Html::activeDropDownList(
                        $especies, 'idtipo',
                        ArrayHelper::map($tipo_especies,'idestatus','nombre'),
                        ['prompt' => '---- Seleccione ----','class' => 'form-control imput-md']
                    ) ?>
                </div>
            </div>
            <div class="form-group">
                <?= Html::label('Sexo', 'sexo', ['class' => ''])?>
                <div class="">
                    <?= Html::activeDropDownList(
                        $mascota, 'sexo',
                        ArrayHelper::map($sexo,'idestatus','nombre'),
                        ['prompt' => '---- Seleccione ----','class' => 'form-control imput-md']
                    ) ?>
                </div>
            </div>
            <div class="form-group">
                <?= Html::label('Procedencia', 'idprocedencia', ['class' => ''])?>
                <div class="">
                    <?= Html::activeDropDownList(
                        $mascota, 'idprocedencia',
                        ArrayHelper::map($procedencia,'idprocedencia','nombre'),
                        ['prompt' => '---- Seleccione ----','class' => 'form-control imput-md']
                    ) ?>
                </div>
            </div>
            <div class="form-group">
                <?= Html::label('Vacuna', 'vacuna_antirab', ['class' => ''])?>
                <div class="">
                    <?= Html::activeDropDownList(
                        $mascota, 'vacuna_antirab',
                        ArrayHelper::map($selec,'idestatus','nombre'),
                        ['prompt' => '---- Seleccione ----','class' => 'form-control imput-md']
                    ) ?>
                </div>
            </div>
            <div class="form-group">
                <?= Html::label('¿Desparacitado?', 'desparacitado', ['class' => ''])?>
                <div class="">
                    <?= Html::activeDropDownList(
                        $mascota, 'desparacitado',
                        ArrayHelper::map($selec,'idestatus','nombre'),
                        ['prompt' => '---- Seleccione ----','class' => 'form-control imput-md']
                    ) ?>
                </div>
            </div>
            <div class="form-group">
                <?= Html::label('¿Tiene alguna discapacidad?', 'discapacidad', ['class' => ''])?>
                <div class="">
                    <?= Html::activeDropDownList(
                        $mascota, 'discapacidad',
                        ArrayHelper::map($selec,'idestatus','nombre'),
                        ['prompt' => '---- Seleccione ----','class' => 'form-control imput-md']
                    ) ?>
                </div>
            </div>
            <div class="form-group">
                <?= Html::label('¿Toma algún tratamiento?', 'tratamiento', ['class' => ''])?>
                <div class="">
                    <?= Html::activeDropDownList(
                        $mascota, 'tratamiento',
                        ArrayHelper::map($selec,'idestatus','nombre'),
                        ['prompt' => '---- Seleccione ----','class' => 'form-control imput-md']
                    ) ?>
                </div>
            </div>
            <div class="form-group">
                <?= Html::label('¿Esta esterilizado?', 'esterelizado', ['class' => ''])?>
                <div class="">
                    <?= Html::activeDropDownList(
                        $mascota, 'esterelizado',
                        ArrayHelper::map($selec,'idestatus','nombre'),
                        ['prompt'=>'---- Seleccione ----','class' => 'form-control imput-md']
                    ) ?>
                </div>
            </div>

            <div class="form-group">
                <?= Html::submitButton('Crear reporte PDF', ['class' => 'btn btn-primary']) ?>
                <?= Html::submitButton('Crear reporte EXCEL', ['class' => 'btn btn-primary']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
