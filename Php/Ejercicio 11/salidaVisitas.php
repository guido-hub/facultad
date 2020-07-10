<?php
//sleep(3);
//$conexion1 = new mysqli("localhost","labo3","abc123","labo3");

$conexion2 = new mysqli("sql10.freemysqlhosting.net:3306","sql10352817","xLJQbXIj1E","sql10352817");

if($conexion2->connect_errno){
	echo "Falló la conexion " . $conexion2->connect_errno;
}

$conexion2->set_charset("utf8");

$orden=$_GET['orden'];

$sql = "SELECT * FROM gimnasio ORDER BY ".$orden;

$resultado=$conexion2->query($sql);

if($conexion2->errno){
	die($conexion2->error);
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