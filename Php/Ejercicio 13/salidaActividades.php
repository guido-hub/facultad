<?php
sleep("2");

$conexion = new mysqli("localhost","labo3","abc123","labo3");

if($conexion->connect_errno){
    $puntero=fopen("./errores.log","a");
    fwrite($puntero,"Fallo conexion en la base de datos: ");
    fwrite($puntero,$conexion->connect_errno."\n ");
    $fecha=date("Y-m-d");
    fwrite($puntero,date("Y-m-d H-i")."\n ");
    fwrite($puntero,"\n");
    fclose($puntero);
    die();	
}

$conexion->set_charset("utf8");

$sql = "SELECT * FROM actividades";

$resultado=$conexion->query($sql);

if($conexion->errno){
    $puntero=fopen("./errores.log","a");
    fwrite($puntero,"Fallo en la ejecucion de la sentencia sql: ");
    fwrite($puntero,$conexion->connect_errno."\n ");
    $fecha=date("Y-m-d");
    fwrite($puntero,date("Y-m-d H-i")."\n ");
    fwrite($puntero,"\n");
    fclose($puntero);
    die();  
}
		
$resultadoCuentaRegistros = $resultado->num_rows;

$actividades=[];

while($fila=$resultado->fetch_assoc()){
    $objActividad=new stdClass();
    $objActividad->ID=$fila['ID'];
    $objActividad->Nombre=$fila['Nombre'];    
    array_push($actividades,$objActividad);
}

$objDeportes=new stdClass();

$objDeportes->deportes=$actividades;

$objDeportes->cuenta=$resultadoCuentaRegistros;

$salidaJSON=json_encode($objDeportes);

$conexion->close();

echo $salidaJSON;
?>