<?php
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

$sql = "SELECT * FROM gimnasio ORDER BY ID";
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

$i = 1;
$idFaltante=1;
$num=false;

while($fila=$resultado->fetch_assoc()){
    if(!($fila['ID']==$i) && $num==false){
        $idFaltante=$i;
        $num = true;
    }
    $i = $i+1;
}

if($num==false){
    $idFaltante=$i;
}

$objRegistro=new stdClass();
$objRegistro->idFaltante=$idFaltante;

$salidaJSON=json_encode($objRegistro);

$conexion->close();

echo $salidaJSON;
?>