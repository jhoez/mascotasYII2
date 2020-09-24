<?php if($mascota !== null):?>
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
            <table class="table table-bordered">
                <!-- primera fila -->
                <thead>
                    <tr>
                        <th style="background-color:#28a745;">Isla - Cayo</th>
                        <th>Calle</th>
                        <th>Tipo de Mascota</th>
                        <th>Sexo</th>
                        <th>Procedencia</th>
                        <th>Raza</th>
                        <th>Color</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?=$data['nombisla']; ?></td>
                        <td><?=$data['nombre_calle']; ?></td>
                        <td><?=$data['especie_mascota'] == '2' ? 'Perro' : 'Gato'; ?></td>
                        <td><?=$data['sexo_mascota']; ?></td>
                        <td><?=$data['procedencia_mascota']; ?></td>
                        <td><?=$data['raza_mascota']; ?></td>
                        <td><?=$data['color_mascota']; ?></td>
                    </tr>
                </tbody>

                <thead>
                    <tr>
                        <th>Vacunado antirrabica</th>
                        <th>Desparacitado</th>
                        <th>Tiene discapacidad</th>
                        <th>Discapacidad</th>
                        <th>Tiene tratamiento</th>
                        <th>Tratamiento</th>
                        <th>Esterilizado</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?=$data['vacunado_mascota']; ?></td>
                        <td><?=$data['esta_desparacitado']; ?></td>
                        <td><?=$data['tiene_discapacidad']; ?></td>
                        <td><?=$data['discanimal']; ?></td>
                        <td><?=$data['tiene_trataramiento']; ?></td>
                        <td><?=$data['tratanimal']; ?></td>
                        <td><?=$data['estere']; ?></td>
                    </tr>
                </tbody>
            </table>
        <?php endforeach; ?>
    </page>
<?php endif;?>
