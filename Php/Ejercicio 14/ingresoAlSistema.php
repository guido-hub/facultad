<?php
function conectar1(){
    sleep(2);
    $server = "localhost";
    $user   = "labo3";
    $pass   = "abc123";
    $base   = "labo3";
    return new mysqli($server,$user,$pass,$base);
}
function conectar2(){
    $server = "sql10.freemysqlhosting.net:3306";
    $user   = "sql10352817";
    $pass   = "xLJQbXIj1E";
    $base   = "sql10352817";
    return new mysqli($server,$user,$pass,$base);
}

$usuario = $_GET['user'];
$clave = $_GET['pass'];

if(!Autenticacion($usuario,$clave)){
    header('location:./login.html');
    exit();
}

function Autenticacion($user,$pass){
    $conexion = conectar1();
    $passEncripted=sha1($pass);

    $sql = "SELECT * FROM usuarios WHERE Nombre = '".$user."' AND Clave = '".$passEncripted."' ";               
    $resultado = $conexion->query($sql);
    $fila=$resultado->fetch_assoc();    
    if($fila['Nombre']==$user && $fila['Clave']==$passEncripted){
        $Aceptado=true;
    }
    else{
        $Aceptado=false;
    }
    $conexion->close();
    return $Aceptado;   
}

session_start();

$_SESSION['IdDeSesion']=session_id();
$_SESSION['log']=$usuario;
echo "<html style='background-color:antiquewhite'>";
echo "<div style='height:32%;width:50%;position:relative;left:25%;top:25%;border:solid 2px black;background-color:aqua;padding-left:5%;box-sizing:border-box'>";
echo "<h2>Nombre de usuario que ha iniciado sesión:</h2>";
echo "<h2>".$_SESSION['log']."</h2>";
echo "<h2>Identificativo de sesión otorgado:</h2>";
echo "<h2>".$_SESSION['IdDeSesion']."</h2>";
echo "</div>";
echo "<p><button onClick=\"location.href='./Modulo1'\" style='position:absolute;top:64%;left:26%'>Ingrese a la aplicación</button></p>";
echo "<p><button onClick=\"location.href='./destruirSesion.php'\" style='position:absolute;top:64%;left:40%'>Terminar sesion</button></p>";
echo "</html>";
?>