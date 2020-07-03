<?php
sleep(2);

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

$inpID = $_GET['id'];
$inpNombre = $_GET['nombre'];
$inpApellido = $_GET['apellido'];
$inpActividad = $_GET['actividad'];
$inpFecha = $_GET['fecha'];

$sql = "UPDATE gimnasio SET ID=?,Nombre=?,Apellido=?,Actividad=?,Fecha=? WHERE ID=?";

$resultado=$conexion->prepare($sql);

$resultado->bind_param('issssi',$inpID,$inpNombre,$inpApellido,$inpActividad,$inpFecha,$inpID);

$resultado->execute();

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

$conexion->close();

?>