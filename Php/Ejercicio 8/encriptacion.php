<?php
sleep(3);
$varAEncriptar=$_POST['clave'];
$claveEncriptada=md5($varAEncriptar);
echo "Clave a encriptar: " . $varAEncriptar . "<br>";
echo "Clave encriptada en md5: (128 bits o 16 pares hexadecimales)" . "<br>";
echo $claveEncriptada . "<br><br>";
$claveEncriptada=sha1($varAEncriptar);
echo "Clave a encriptar: " . $varAEncriptar . "<br>";
echo "Clave encriptada en sha1: (160 bits o 20 pares hexadecimales)" . "<br>";
echo $claveEncriptada;
?>