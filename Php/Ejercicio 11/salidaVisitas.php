<?php
sleep(3);

$conexion = new mysqli("localhost","labo3","abc123","labo3");

if($conexion->connect_errno){
	echo "Falló la conexion " . $conexion->connect_errno;
}

$conexion->set_charset("utf8");

$orden=$_GET['orden'];

$sql = "SELECT * FROM gimnasio ORDER BY ".$orden;

$resultado=$conexion->query($sql);

if($conexion->errno){
	die($conexion->error);
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

$conexion->close();

echo $salidaJSON;
?>