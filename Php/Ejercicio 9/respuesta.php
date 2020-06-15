<?php
sleep(3);
$objPersona = new stdclass;
$objPersona->nombres=$_POST['nombres'];
$objPersona->apellido=$_POST['apellido'];
$objPersona->login=$_POST['login'];
$objPersona->fechaNacimiento=$_POST['fechaNacimiento'];

$jsonPersona = json_encode($objPersona);
echo $jsonPersona;
?>