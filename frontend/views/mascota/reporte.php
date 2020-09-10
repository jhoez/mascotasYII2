<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Reportes de Mascotas';
$this->params['breadcrumbs'][] = $this->title;
?>

<p>
    <?= Html::a('Create Mascota', ['create'], ['class' => 'btn btn-primary']) ?>
</p>

<div class="row clearfix">
    <div class="col-md-offset-2 col-md-8 col-md-offset-2">
        <div class="registro-form">
            <h1><?= Html::encode($this->title) ?></h1>
            <?php $form = ActiveForm::begin(); ?>

            <div class="form-group">
                <div class="">
                    <?= $form->field($direccion, 'idislas')->dropDownList(
                        $islas,
                        [
                            'empty' => 'Islas - Cayos',
                        ]
                        ) ?>
                </div>
            </div>
            <div class="form-group">
                <div class="">
                    <?= $form->field($direccion, 'id_calle')->dropDownList(
                        $calle,
                        ['empty'=>'Seleccione la calle','class' => 'form-control imput-md']
                        ) ?>
                </div>
            </div>
            <div class="form-group">
                <div class="">
                    <?= $form->field($especies, 'idtipo')->dropDownList(
                        $tipo_especies,
                        ['empty' => 'Tipop de mascota','class' => 'form-control imput-md']
                        ) ?>
                </div>
            </div>
            <div class="form-group">
                <div class="">
                    <?= $form->field($mascota, 'sexo')->dropDownList(
                        $sexo,
                        ['empty' => 'Seleccione','class' => 'form-control imput-md']
                        ) ?>
                </div>
            </div>
            <div class="form-group">
                <div class="">
                    <?= $form->field($mascota, 'idprocedencia')->dropDownList(
                        $procedencia,
                        ['empty' => 'Seleccione','class' => 'form-control imput-md']
                        ) ?>
                </div>
            </div>
            <div class="form-group">
                <div class="">
                    <?= $form->field($mascota, 'vacuna_antirab')->dropDownList(
                        $selec,
                        ['empty' => 'Vacunado antirrabica','class' => 'form-control imput-md']
                        ) ?>
                </div>
            </div>
            <div class="form-group">
                <div class="">
                    <?= $form->field($mascota, 'desparacitado')->dropDownList(
                        $selec,
                        ['empty' => '¿Desparacitado?','class' => 'form-control imput-md']
                        ) ?>
                </div>
            </div>
            <div class="form-group">
                <div class="">
                    <?= $form->field($mascota, 'discapacidad')->dropDownList(
                        $selec,
                        ['empty' => '¿Tiene una Discapacidad?','class' => 'form-control imput-md']
                        ) ?>
                </div>
            </div>
            <div class="form-group">
                <div class="">
                    <?= $form->field($mascota, 'tratamiento')->dropDownList(
                        $selec,
                        ['empty' => '¿Toma algún tratamiento?','class' => 'form-control imput-md']
                        ) ?>
                </div>
            </div>
            <div class="form-group">
                <div class="">
                    <?= $form->field($mascota, 'esterelizado')->dropDownList(
                        $selec,
                        ['empty'=>'¿Esta esterilizado?','class' => 'form-control imput-md']
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
