<?php
sleep(1);

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

$sql = "SELECT * FROM borrados ORDER BY Numero";
$resultado1=$conexion->query($sql);

$sql = "SELECT * FROM gimnasio";
$resultado2=$conexion->query($sql);

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

$fila=$resultado1->fetch_assoc();
$objRegistro=new stdClass();
$objRegistro->numeroBorrado=$fila['Numero'];

$objRegistro->ultimoID=$resultado2->num_rows;

$salidaJSON=json_encode($objRegistro);

$conexion->close();

echo $salidaJSON;
?>