<?php
sleep(2);
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
$inpNombre = $_GET['nombre'];
$inpApellido = $_GET['apellido'];
$inpActividad = $_GET['actividad'];
$inpFecha = $_GET['fecha'];

$sql = "INSERT INTO gimnasio (ID,Nombre,Apellido,Actividad,Fecha) VALUES (?,?,?,?,?)";
$resultado=$conexion->prepare($sql);
if($resultado==false){error("prepare");}
$resultado->bind_param("issss",$inpID,$inpNombre,$inpApellido,$inpActividad,$inpFecha);
if($resultado==false){error("vinculo");}
$resultado->execute();
if($resultado==false){error("alta");}

function error($tipo){
    $puntero=fopen("./errores.log","a");
    if($tipo=="prepare"){fwrite($puntero,"Fallo en la preparación de la sentencia del query: ");}
    if($tipo=="vinculo"){fwrite($puntero,"Fallo al realizar el vínculo con el query: ");}
    if($tipo=="alta"){fwrite($puntero,"Fallo en la ejecucion del alta solicitada: ");}
    if($tipo=="modi"){fwrite($puntero,"Fallo en la ejecucion de la modificación del query: ");}
    if($tipo=="borrado"){fwrite($puntero,"Fallo en la ejecucion del borrado solicitado: ");}
    if($tipo=="lectura"){fwrite($puntero,"Fallo en la ejecucion de la lectura del query: ");}
    fwrite($puntero,$conexion->error."\n ");
    fwrite($puntero,$conexion->errno."\n ");
    $fecha=date("Y-m-d");
    fwrite($puntero,date("Y-m-d H-i")."\n ");
    fwrite($puntero,"\n");
    fclose($puntero);
    die();  
}

$conexion->close();

?>