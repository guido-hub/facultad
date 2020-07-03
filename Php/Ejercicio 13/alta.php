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

$sql = "INSERT INTO gimnasio (ID,Nombre,Apellido,Actividad,Fecha) VALUES (?,?,?,?,?)";
$resultado=$conexion->prepare($sql);
$resultado->bind_param("issss",$inpID,$inpNombre,$inpApellido,$inpActividad,$inpFecha);
$resultado->execute();

$sql = "DELETE FROM borrados WHERE Numero = ".$inpID;
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

$conexion->close();

?>