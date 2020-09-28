<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

?>

<div class="row clearfix">
    <div class="col-md-offset-2 col-md-8 col-md-offset-2">
        <div class="mascota-form">
            <?php $form = ActiveForm::begin([
                'enableClientValidation'=>true,
                
            ]); ?>
            <h3>Datos del dueño de la mascota</h3>
            <hr>
            <div class="form-group">
                <?= Html::label('Nacionalidad', 'nacionalidad', ['class' => '']) ?>
                <div class="">
                    <?= Html::activeDropDownList(
                        $propietario, 'nacionalidad',
                        [
                            'V' => 'Venezolano',
                            'E' => 'Extranjero',
                        ],
                        ['prompt' => '---- Seleccione ----','class' => 'form-control imput-md']
                    )?>
                </div>
                <? ?>
            </div>
            <div class="form-group">
                <div class="">
                    <?= $form->field($propietario, 'cedula')->textInput(['class' => 'form-control imput-md']) ?>
                </div>
            </div>
            <div class="form-group">
                <div class="">
                    <?= $form->field($propietario, 'nombres')->textInput(['class' => 'form-control imput-md']) ?>
                </div>
            </div>
            <div class="form-group">
                <div class="">
                    <?= $form->field($propietario, 'apellidos')->textInput(['class' => 'form-control imput-md']) ?>
                </div>
            </div>
            <div class="form-group">
                <?= Html::label('Islas - Cayos', 'idislas', ['class' => ''])?>
                <div class="">
                    <?= Html::activeDropDownList(
                        $direccion,'idislas',
                        ArrayHelper::map($islas, 'idislas', 'nombre'),
                        ['prompt' => '---- Seleccione ----','class' => 'form-control imput-md']
                    )?>
                </div>
            </div>
            <div class="form-group">
                <div class="">
                    <?= $form->field($direccion, 'ncasa')->textInput(['class' => 'form-control imput-md']) ?>
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
                <div class="">
                    <?= $form->field($propietario, 'correo')->textInput(['class' => 'form-control imput-md']) ?>
                </div>
            </div>
            <div class="form-group">
                <div class="">
                    <?= $form->field($propietario, 'telefono')->textInput(['class' => 'form-control imput-md']) ?>
                </div>
            </div>

            <h3>Datos de la Mascota</h3>
            <hr>

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
                <div class="">
                    <?= $form->field($mascota, 'nombre')->textInput(['class' => 'form-control imput-md']) ?>
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
                <div class="">
                    <?= $form->field($mascota, 'edad')->textInput(['class' => 'form-control imput-md']) ?>
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
                <div class="">
                    <?= $form->field($especies, 'raza')->textInput(['class' => 'form-control imput-md']) ?>
                </div>
            </div>
            <div class="form-group">
                <div class="">
                    <?= $form->field($especies, 'color')->textInput(['class' => 'form-control imput-md']) ?>
                </div>
            </div>
            <div class="form-group">
                <?= Html::label('Esta Vacunado', 'statusvacunado', ['class' => ''])?>
                <div class="">
                    <?= Html::activeDropDownList(
                        $mascota, 'statusvacunado',
                        ArrayHelper::map($selec,'idestatus','nombre'),
                        ['prompt' => '---- Seleccione ----','class' => 'form-control imput-md']
                    ) ?>
                </div>
            </div>
            <div class="form-group">
                <?= Html::label('¿Esta Desparacitado?', 'statusdesparacitado', ['class' => ''])?>
                <div class="">
                    <?= Html::activeDropDownList(
                        $mascota, 'statusdesparacitado',
                        ArrayHelper::map($selec,'idestatus','nombre'),
                        ['prompt' => '---- Seleccione ----','class' => 'form-control imput-md']
                    ) ?>
                </div>
            </div>
            <div class="form-group">
                <?= Html::label('¿Tiene alguna discapacidad?', 'statusdiscapacidad', ['class' => ''])?>
                <div class="">
                    <?= Html::activeDropDownList(
                        $mascota, 'statusdiscapacidad',
                        ArrayHelper::map($selec,'idestatus','nombre'),
                        ['prompt' => '---- Seleccione ----','class' => 'form-control imput-md']
                    ) ?>
                </div>
            </div>
            <div class="form-group">
                <div class="">
                    <?= $form->field($discapacidad, 'nombre')->textInput(['maxlength' => true,'class' => 'form-control imput-md']) ?>
                </div>
            </div>
            <div class="form-group">
                <?= Html::label('¿Toma algún tratamiento?', 'statustratamiento', ['class' => ''])?>
                <div class="">
                    <?= Html::activeDropDownList(
                        $mascota, 'statustratamiento',
                        ArrayHelper::map($selec,'idestatus','nombre'),
                        ['prompt' => '---- Seleccione ----','class' => 'form-control imput-md']
                    ) ?>
                </div>
            </div>
            <div class="form-group">
                <div class="">
                    <?= $form->field($tratamiento, 'nombre')->textInput(['class' => 'form-control imput-md']) ?>
                </div>
            </div>
            <div class="form-group">
                <?= Html::label('¿Esta esterilizado?', 'statusesterilizado', ['class' => ''])?>
                <div class="">
                    <?= Html::activeDropDownList(
                        $mascota, 'statusesterilizado',
                        ArrayHelper::map($selec,'idestatus','nombre'),
                        ['prompt'=>'---- Seleccione ----','class' => 'form-control imput-md']
                    ) ?>
                </div>
            </div>

            <div class="form-group">
                <?= Html::submitButton($mascota->isNewRecord ? 'Registrar Mascota' : 'Actualizar', ['class' => 'btn btn-success']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
