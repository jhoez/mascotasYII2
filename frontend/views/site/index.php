<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */

$this->title = 'Mascotas';
?>
<div class="site-index">

    <div class="jumbotron">
        <h2>REGISTRO Y CONTROL DE MASCOTAS EN EL ARCHIPIELAGO LOS ROQUES</h2>
    </div>

    <div class="body-content">
        <div class="row">
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#myCarousel" data-slide-to="1"></li>
                    <li data-target="#myCarousel" data-slide-to="2"></li>
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                    <div class="item active">
                        <div class="col-md-4">
                            <a href="http://www.tifm.gob.ve/satim/images/documentos/Normas%20_de_Convivencia_Comunal_TIFM_40.366_31.pdf" class="carousel-item" href="#uno!">
                                <img src="<?=Yii::$app->request->baseUrl;?>/images/normas.jpg" alt="Lights" style="width:100%; height:220px;">
                                <div class="caption">
                                    <p>Normas de convivencia comunal</p>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="https://www.affinity-petcare.com/vetsandclinics/es/como-realizar-un-buen-diagnostico-diferencial-de-las-diarreas-caninas" class="carousel-item" href="#dos!">
                                <img src="<?=Yii::$app->request->baseUrl; ?>/images/puntuacion-jc-030a.jpg" style="width:100%; height:220px;">
                                <div class="caption">
                                    <p>Diagnostico diferencial</p>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="http://www.ultimasnoticias.com.ve/noticias/tu-mascota/mision-nevado-ofrece-atencion-de-emergencia-durante-cuarentena/" class="carousel-item" href="#tres!">
                                <img src="<?=Yii::$app->request->baseUrl; ?>/images/unnamed.jpg" style="width:100%; height:220px;">
                                <div class="caption">
                                    <p>Mision Nevado</p>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="item">
                        <div class="col-md-4">
                            <a href="https://www.affinity-petcare.com/vetsandclinics/es/atopia-gemfe-2016-lo-mas-destacado-en-medicina-felina" class="carousel-item" href="#cuatro!">
                                <img src="<?php echo Yii::$app->request->baseUrl; ?>/images/foto_capcalera_post_6.jpg" style="width:100%; height:220px;">
                                <div class="caption">
                                    <p>Medicina Felina</p>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="https://www.affinity-petcare.com/vetsandclinics/es/lo-mas-comentado-en-el-congreso-amvac-2016" class="carousel-item" href="#cinco!">
                                <img src="<?php echo Yii::$app->request->baseUrl; ?>/images/cecilia-0285.jpg" style="width:100%; height:220px;">
                                <div class="caption">
                                    <p>Affinity petcare</p>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="https://www.affinity-petcare.com/vetsandclinics/es/coronavirus-canino-como-reforzar-el-sistema-inmune-en-cachorros" class="carousel-item" href="#seis!">
                                <img src="<?php echo Yii::$app->request->baseUrl; ?>/images/foto_capcalera_post_12_2.jpg" style="width:100%; height:220px;">
                                <div class="caption">
                                    <p>Coronavirus canino</p>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="item">
                        <div class="col-md-4">
                            <a href="https://www.affinity-petcare.com/vetsandclinics/es/leishmaniosis-en-perros-existe-una-dieta-especifica" class="carousel-item" href="#siete!">
                                <img src="<?php echo Yii::$app->request->baseUrl; ?>/images/coronavirus_canino_0.jpg" style="width:100%; height:220px;">
                                <div class="caption">
                                    <p>leishmaniosis en perros</p>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="https://www.affinity-petcare.com/vetsandclinics/es/epilepsia-en-perros-novedades-y-abordaje-terapeutico-del-estatus" class="carousel-item" href="#ocho!">
                                <img src="<?php echo Yii::$app->request->baseUrl; ?>/images/annabel-3300b.png" style="width:100%; height:220px;">
                                <div class="caption">
                                    <p>Epilepsia en perros</p>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="https://www.affinity-petcare.com/vetsandclinics/es/actualizacion-de-hipotiroidismo-en-perros" class="carousel-item" href="#nueve!">
                                <img src="<?php echo Yii::$app->request->baseUrl; ?>/images/pedro-4164.jpg" style="width:100%; height:220px;">
                                <div class="caption">
                                    <p>Actualización de hipotiroides en perros</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- Left and right controls -->
                <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#myCarousel" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>

        <!-- FORMULARIO DE REGISTRO DE MASCOTAS -->
        <div class="jumbotron">
            <h2>Formulario de registro de Mascotas</h2>
        </div>

        <div class="row clearfix">
            <div class="col-md-offset-2 col-md-8 col-md-offset-2">
                <div class="site-form">
                    <?php $form = ActiveForm::begin(); ?>
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
                            <?= $form->field($propietario, 'nombres')->textInput(['maxlength' => true,'class' => 'form-control imput-md']) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="">
                            <?= $form->field($propietario, 'apellidos')->textInput(['maxlength' => true,'class' => 'form-control imput-md']) ?>
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
                            <?= $form->field($direccion, 'ncasa')->textInput(['maxlength' => true,'class' => 'form-control imput-md']) ?>
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
                            <?= $form->field($propietario, 'correo')->textInput(['maxlength' => true,'class' => 'form-control imput-md']) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="">
                            <?= $form->field($propietario, 'telefono')->textInput(['maxlength' => true,'class' => 'form-control imput-md']) ?>
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
                            <?= $form->field($mascota, 'nombre')->textInput(['maxlength' => true,'class' => 'form-control imput-md']) ?>
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
                            <?= $form->field($mascota, 'edad')->textInput(['maxlength' => true,'class' => 'form-control imput-md']) ?>
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
                            <?= $form->field($especies, 'raza')->textInput(['maxlength' => true,'class' => 'form-control imput-md']) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="">
                            <?= $form->field($especies, 'color')->textInput(['maxlength' => true,'class' => 'form-control imput-md']) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <?= Html::label('Esta Vacunado', 'vacuna_antirab', ['class' => ''])?>
                        <div class="">
                            <?= Html::activeDropDownList(
                                $mascota, 'vacuna_antirab',
                                ArrayHelper::map($selec,'idestatus','nombre'),
                                ['prompt' => '---- Seleccione ----','class' => 'form-control imput-md']
                            ) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <?= Html::label('¿Esta Desparacitado?', 'desparacitado', ['class' => ''])?>
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
                            <?= $form->field($discapacidad, 'nombre')->textInput(['maxlength' => true,'class' => 'form-control imput-md']) ?>
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
                            <?= $form->field($tratamiento, 'nombre')->textInput(['maxlength' => true,'class' => 'form-control imput-md']) ?>
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
                        <?= Html::submitButton('Registrar mascota', ['class' => 'btn btn-success']) ?>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>

    </div>
</div>
