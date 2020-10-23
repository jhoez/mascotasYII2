<?php

$query = new Query;
$query ->select([
    'regmasc.islas.nombre as nombisla',
    'carnet.calle.nombre as nombre_calle',
    'regmasc.especies.idtipo as especie_mascota',
    'regmasc.mascota.nombre as nombre_mascota',
    'sexo.nombre as sexo_mascota',
    'regmasc.mascota.edad as anio_mascota',
    'regmasc.procedencia.nombre as procedencia_mascota',
    'regmasc.especies.raza as raza_mascota',
    'regmasc.especies.color as color_mascota',
    'vacuna.nombre as vacunado_mascota',
    'despa.nombre as esta_desparacitado',
    'disc.nombre as tiene_discapacidad',
    'disca.nombre as discanimal',
    'tra.nombre as tiene_trataramiento',
    'trata.nombre as tratanimal',
    'este.nombre as estere'
])
->from('regmasc.mascota');
$query->join(
    'INNER JOIN',
    'regmasc.propietario',
    'regmasc.propietario.idpropietario = regmasc.mascota.idpropietario'
);
$query->join(
    'INNER JOIN',
    'regmasc.direccion',
    'regmasc.direccion.idpropietario = regmasc.propietario.idpropietario'
);
$query->join(
    'INNER JOIN',
    'regmasc.islas',
    'regmasc.islas.idislas = regmasc.direccion.idislas'
);
$query->join(
    'INNER JOIN',
    'carnet.calle',
    'carnet.calle.id = regmasc.direccion.id_calle'
);
$query->join(
    'INNER JOIN',
    'regmasc.especies',
    'regmasc.especies.idespecies = regmasc.mascota.idespecies'
);
$query->join(
    'INNER JOIN',
    'regmasc.estatus as sexo',
    'sexo.idestatus = regmasc.mascota.sexo'
);
$query->join(
    'INNER JOIN',
    'regmasc.procedencia',
    'regmasc.procedencia.idprocedencia = regmasc.mascota.idprocedencia'
);
$query->join(
    'INNER JOIN',
    'regmasc.estatus as vacuna',
    'vacuna.idestatus = regmasc.mascota.statusvacunado'
);
$query->join(
    'INNER JOIN',
    'regmasc.estatus as despa',
    'despa.idestatus = regmasc.mascota.statusdesparacitado'
);
$query->join(
    'INNER JOIN',
    'regmasc.estatus as disc',
    'disc.idestatus = regmasc.mascota.statusdiscapacidad'
);
$query->join(
    'INNER JOIN',
    'regmasc.estatus as tra',
    'tra.idestatus = regmasc.mascota.statustratamiento'
);
$query->join(
    'INNER JOIN',
    'regmasc.estatus as este',
    'este.idestatus = regmasc.mascota.statusesterilizado'
);
$query->join(
    'INNER JOIN',
    'regmasc.discapacidad as disca',
    'disca.idmascota = regmasc.mascota.idmascota'
);
$query->join(
    'INNER JOIN',
    'regmasc.tratamiento as trata',
    'trata.idmascota = regmasc.mascota.idmascota'
);

if ( !empty($isla->idislas) ){
    $query->andWhere(['regmasc.direccion.idislas'=>$isla->idislas]);
}
if ( !empty($direccion->id_calle) ){
    $query->andWhere(['regmasc.direccion.id_calle'=>$direccion->id_calle]);
}
if ( !empty($especies->idtipo) ){
    $query->andWhere(['regmasc.especies.idtipo'=>$especies->idtipo]);
}
if ( !empty($mascota->sexo) ){
    $query->andWhere(['regmasc.mascota.sexo'=>$mascota->sexo]);
}
if ( !empty($mascota->idpropietario) ){
    $query->andWhere(['regmasc.mascota.idprocedencia'=>$mascota->idpropietario]);
}
if ( !empty($mascota->statusvacunado) ){
    $query->andWhere(['regmasc.mascota.statusvacunado'=>$mascota->statusvacunado]);
}
if ( !empty($mascota->statusdesparacitado) ){
    $query->andWhere(['regmasc.mascota.statusdesparacitado'=>$mascota->statusdesparacitado]);
}
if ( !empty($mascota->statusdiscapacidad) ){
    $query->andWhere(['regmasc.mascota.statusdiscapacidad'=>$mascota->statusdiscapacidad]);
}
if ( !empty($mascota->statustratamiento) ){
    $query->andWhere(['regmasc.mascota.statustratamiento'=>$mascota->statustratamiento]);
}
if ( !empty($mascota->statusesterilizado) ){
    $query->andWhere(['regmasc.mascota.statusesterilizado'=>$mascota->statusesterilizado]);
}

//echo "<pre>";var_dump($_POST);die;
$command = $query->createCommand();
$mascota = $command->queryAll();
//echo "<pre>";var_dump($command->sql,$mascota);die;

?>
