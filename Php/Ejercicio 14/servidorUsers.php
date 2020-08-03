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
$conexion = conectar1();

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

$accion = $_GET['accion']; 

if($accion=="altaUser"){   
    $sql = "SELECT * FROM usuarios ORDER BY Numero";
    $resultado=$conexion->query($sql);
    if($resultado==false){error("lectura");}

    $i = 1;
    $idFaltante=1;
    $num=false;
    while($fila=$resultado->fetch_assoc()){        
        if(!($fila['Numero']==$i) && $num==false){
            $idFaltante=$i;
            $num = true;
        }
        $i = $i+1;
    }
    if($num==false){$idFaltante=$i;}              
    
    $inpNumero = $idFaltante; 
    $inpNombre = $_GET['nombre'];    
    $inpClave = $_GET['clave'];      
    $claveEncriptada=sha1($inpClave);

    $sql = "INSERT INTO usuarios (Numero,Nombre,Clave) VALUES (?,?,?)";
    $resultado=$conexion->prepare($sql);
    if($resultado==false){error("prepare");}
    $resultado->bind_param("iss",$inpNumero,$inpNombre,$claveEncriptada);
    if($resultado==false){error("vinculo");}
    $resultado->execute();
    if($resultado==false){error("alta");}

    $conexion->close();
}

if($accion=="bajaUser"){
    $inpNumero = $_GET['numero'];

    $sql = "DELETE FROM usuarios WHERE Numero = ".$inpNumero;    
    $resultado=$conexion->query($sql);
    if($resultado==false){error("borrado");}

    $conexion->close();
}

if($accion=="salidaUsers"){    
    $ordenanza = $_GET['ordenanza']; 

    $sql = "SELECT * FROM usuarios ORDER BY ".$ordenanza;

    $resultado=$conexion->query($sql);
    if($resultado==false){error("lectura");}
    $usuarios=[];
    while($fila=$resultado->fetch_assoc()){
        $objUser=new stdClass();
        $objUser->Numero=$fila['Numero'];
        $objUser->Nombre=$fila['Nombre'];
        $objUser->Clave=$fila['Clave'];
        array_push($usuarios,$objUser);
    }
    $objUsuarios=new stdClass();
    $objUsuarios->usuarios=$usuarios;
    $objUsuarios->cuenta=$resultado->num_rows;
    $salidaJSON=json_encode($objUsuarios);
    $conexion->close();
    echo $salidaJSON;
}

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
?>