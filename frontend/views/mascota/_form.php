<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

?>

<div class="row clearfix">
    <div class="col-md-offset-2 col-md-8 col-md-offset-2">
        <div class="registro-form">
            <?php $form = ActiveForm::begin([
                //'method'=>'POST',
                //'enableClientValidation'=>true
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
            </div>
            <div class="form-group">
                <div class="">
                    <?= $form->field($propietario, 'cedula')->textInput(['maxlength' => true,'class' => 'form-control imput-md']) ?>
                </div>
            </div>
            <div class="form-group">
                <div class="">
                    <?= $form->field($propietario, 'nombres')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
            <div class="form-group">
                <div class="">
                    <?= $form->field($propietario, 'apellidos')->textInput(['maxlength' => true]) ?>
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
                    <?= $form->field($direccion, 'ncasa')->textInput(['maxlength' => true]) ?>
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
                    <?= $form->field($propietario, 'correo')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
            <div class="form-group">
                <div class="">
                    <?= $form->field($propietario, 'telefono')->textInput(['maxlength' => true]) ?>
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
                    <?= $form->field($mascota, 'nombre')->textInput(['maxlength' => true]) ?>
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
                    <?= $form->field($mascota, 'edad')->textInput(['maxlength' => true]) ?>
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
                    <?= $form->field($especies, 'raza')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
            <div class="form-group">
                <div class="">
                    <?= $form->field($especies, 'color')->textInput(['maxlength' => true]) ?>
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
                <div class="">
                    <?= $form->field($discapacidad, 'nombre')->textInput(['maxlength' => true]) ?>
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
                <div class="">
                    <?= $form->field($tratamiento, 'nombre')->textInput() ?>
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
                <?= Html::submitButton($mascota->isNewRecord ? 'Registrar Mascota' : 'Actualizar', ['class' => 'btn btn-success']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
