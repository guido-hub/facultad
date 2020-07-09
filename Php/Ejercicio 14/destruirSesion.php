<?php
include("./proteccion.php");
session_destroy();
header('location:./login.html');
?>