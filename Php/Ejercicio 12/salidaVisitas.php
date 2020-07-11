<?php
//sleep(3);
//$conexion1 = new mysqli("localhost","labo3","abc123","labo3");

$conexion2 = new mysqli("sql10.freemysqlhosting.net:3306","sql10352817","xLJQbXIj1E","sql10352817");

if($conexion2->connect_errno){
    $puntero=fopen("./errores.log","a");
    fwrite($puntero,"Fallo conexion en la base de datos: ");
    fwrite($puntero,$conexion2->connect_errno."\n ");
    $fecha=date("Y-m-d");
    fwrite($puntero,date("Y-m-d H-i")."\n ");
    fwrite($puntero,"\n");
    fclose($puntero);
    die();	
}

$conexion2->set_charset("utf8");

$inpID        = $_GET['inpID'];
$inpNombre    = $_GET['inpNombre'];
$inpApellido  = $_GET['inpApellido'];
$inpActividad = $_GET['inpActividad'];
$inpFecha     = $_GET['inpFecha'];
$orden        = $_GET['orden'];

$sql = "SELECT * FROM gimnasio WHERE ";
$sql = $sql."ID LIKE '%"       .$inpID.       "%' AND ";
$sql = $sql."Nombre LIKE '%"   .$inpNombre.   "%' AND ";
$sql = $sql."Apellido LIKE '%" .$inpApellido. "%' AND ";
$sql = $sql."Actividad LIKE '%".$inpActividad."%' AND ";
$sql = $sql."Fecha LIKE '%"    .$inpFecha.    "%' ";
$sql = $sql."ORDER BY "        .$orden;

$resultado=$conexion2->query($sql);

if($conexion2->errno){
    $puntero=fopen("./errores.log","a");
    fwrite($puntero,"Fallo en la ejecucion de la sentencia sql: ");
    fwrite($puntero,$conexion2->connect_errno."\n ");
    $fecha=date("Y-m-d");
    fwrite($puntero,date("Y-m-d H-i")."\n ");
    fwrite($puntero,"\n");
    fclose($puntero);
    die();  
}
		
$resultadoCuentaRegistros = $resultado->num_rows;

$visitas=[];

while($fila=$resultado->fetch_assoc()){
    $objVisit=new stdClass();
    $objVisit->ID=$fila['ID'];
    $objVisit->Nombre=$fila['Nombre'];
    $objVisit->Apellido=$fila['Apellido'];
    $objVisit->Actividad=$fila['Actividad'];
    $objVisit->Fecha=$fila['Fecha'];
    array_push($visitas,$objVisit);
}

$objVisitas=new stdClass();

$objVisitas->visitas=$visitas;

$objVisitas->cuenta=$resultadoCuentaRegistros;

$salidaJSON=json_encode($objVisitas);

$conexion2->close();

echo $salidaJSON;
?>