<?php if($mascota !== null):?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <style>
        * {
            margin:0px;
            padding:0px;
            font-family: arial;
            font-size: 16px;
        }

        #imgheader, #imgfooter {
            width:100%;
            height:50px;
            margin: 0px;
            padding: 0px;
        }

        .fecha {
            text-align:right;
            margin-right: 10px;
            margin-bottom:10px;
        }
        #titlereport{
            margin:0px auto;
            text-align:center;
            margin-bottom:3px;
        }

        .contentre {
            margin-top:25px;
        }
        .items {
            width:700px;
            max-width: 700px;
            margin-left:46.5px;
            margin-right:46.5px;
            border-collapse: collapse;
        }
        #thead {
            width:100px;
            max-width: 100px;
            padding:5px 0px;
            color: #fff;
            background-color: #a70139;
            font-size:12px;
            vertical-align: middle;
            text-align: center;
        }
        #tbody {
            background-color: #cdcdcd;
            width:100px;
            max-width: 100px;
            padding:5px 0px;
            font-size:10px;
            vertical-align: middle;
            text-align:center;
        }
        </style>
    </head>
<body>
    <page backtop="15" backbottom="15" backleft="0" backright="0">
        <bookmark title="Reporte asistencia" level="0" ></bookmark>
        <page_header>
            <img id="imgheader" src="<?=Yii::$app->request->baseUrl;?>/images/cintillos/header.jpg" alt="">
        </page_header>

        <div class="fecha"><b>Reporte Fecha: </b><?=date("d/m/Y");?></div>
        <div id="titlereport">
            <?php
                setlocale(LC_TIME, 'es_ES.UTF-8');
                $fech = DateTime::createFromFormat('!m',date("m"));
                echo "<h4>Reporte de Mascotas de ".ucwords( (string)strftime("%B",(int)$fech->getTimestamp()) )."</h4>";
            ?>
        </div>
        <?php foreach($mascota as $data): ?>
        <div class="contentre">
            <table class="items" cellpadding="7">
                <!-- primera fila -->
                <thead>
                    <tr>
                        <th id="thead" style="background-color:#28a745;">Isla - Cayo</th>
                        <th id="thead">Calle</th>
                        <th id="thead">Tipo de Mascota</th>
                        <th id="thead">Sexo</th>
                        <th id="thead">Procedencia</th>
                        <th id="thead">Raza</th>
                        <th id="thead">Color</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td id="tbody"><?php ?></td>
                        <td id="tbody"><?php ?></td>
                        <td id="tbody"><?php ?></td>
                        <td id="tbody"><?php ?></td>
                        <td id="tbody"><?php ?></td>
                        <td id="tbody"><?php ?></td>
                        <td id="tbody"><?php ?></td>
                    </tr>
                </tbody>
            </table>
            <table class="items" cellpadding="7">
                <!-- segunda fila -->
                <thead>
                    <tr>
                        <th id="thead">Vacunado antirrabica</th>
                        <th id="thead">Desparacitado</th>
                        <th id="thead">Tiene discapacidad</th>
                        <th id="thead">Discapacidad</th>
                        <th id="thead">Tiene tratamiento</th>
                        <th id="thead">Tratamiento</th>
                        <th id="thead">Esterilizado</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td id="tbody"><?php ?></td>
                        <td id="tbody"><?php ?></td>
                        <td id="tbody"><?php ?></td>
                        <td id="tbody"><?php ?></td>
                        <td id="tbody"><?php ?></td>
                        <td id="tbody"><?php ?></td>
                        <td id="tbody"><?php ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <?php endforeach; ?>
        <!--
        <page_footer>
            <img id="imgfooter" src="<?//=Yii::$app->request->baseUrl;?>/images/cintillos/foot.jpg" alt="">
        </page_footer>
        -->
    </page>
</body>
</html>
<?php endif;?>
