<?php
sleep(1);
include("./conexion.php");

$conexion = conectar2();

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

$sql = "SELECT * FROM gimnasio WHERE ID = ".$inpID;

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

$fila=$resultado->fetch_assoc();
$objVisita=new stdClass();
$objVisita->ID=$fila['ID'];
$objVisita->Nombre=$fila['Nombre'];
$objVisita->Apellido=$fila['Apellido'];
$objVisita->Actividad=$fila['Actividad'];
$objVisita->Fecha=$fila['Fecha'];

$salidaJSON=json_encode($objVisita);

$conexion->close();

echo $salidaJSON;
?>