<?php
include("./proteccion.php");
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

if($accion=="alta"){
    $inpID = $_GET['id'];
    $inpNombre = $_GET['nombre'];
    $inpApellido = $_GET['apellido'];
    $inpActividad = $_GET['actividad'];
    $inpFecha = $_GET['fecha'];

    $sql = "INSERT INTO gimnasio (ID,Nombre,Apellido,Actividad,Fecha) VALUES (?,?,?,?,?)";
    $resultado=$conexion->prepare($sql);
    if($resultado==false){error("prepare");}
    $resultado->bind_param("issss",$inpID,$inpNombre,$inpApellido,$inpActividad,$inpFecha);
    if($resultado==false){error("vinculo");}
    $resultado->execute();
    if($resultado==false){error("alta");}

    $conexion->close();
}

if($accion=="modi"){
    $inpID = $_GET['id'];
    $inpNombre = $_GET['nombre'];
    $inpApellido = $_GET['apellido'];
    $inpActividad = $_GET['actividad'];
    $inpFecha = $_GET['fecha'];

    $sql = "UPDATE gimnasio SET ID=?,Nombre=?,Apellido=?,Actividad=?,Fecha=? WHERE ID=?";
    $resultado=$conexion->prepare($sql);
    if($resultado==false){error("prepare");}
    $resultado->bind_param('issssi',$inpID,$inpNombre,$inpApellido,$inpActividad,$inpFecha,$inpID);
    if($resultado==false){error("vinculo");}
    $resultado->execute();
    if($resultado==false){error("modi");}

    $conexion->close();
}

if($accion=="baja"){
    $inpID = $_GET['id'];

    $sql = "DELETE FROM gimnasio WHERE ID = ".$inpID;    
    $resultado=$conexion->query($sql);
    if($resultado==false){error("borrado");}

    $conexion->close();
}

if($accion=="obtenerID"){
    $sql = "SELECT * FROM gimnasio ORDER BY ID";
    $resultado=$conexion->query($sql);
    if($resultado==false){error("lectura");}

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
    if($num==false){$idFaltante=$i;}
    $objRegistro=new stdClass();
    $objRegistro->idFaltante=$idFaltante;
    $salidaJSON=json_encode($objRegistro);
    $conexion->close();
    echo $salidaJSON;
}

if($accion=="salidaActividades"){
    $sql = "SELECT * FROM actividades";
    $resultado=$conexion->query($sql);
    if($resultado==false){error("lectura");}
    
    $actividades=[];
    while($fila=$resultado->fetch_assoc()){
        $objActividad=new stdClass();        
        $objActividad->Nombre=$fila['Nombre'];    
        array_push($actividades,$objActividad);
    }
    $objDeportes=new stdClass();
    $objDeportes->deportes=$actividades;    
    $salidaJSON=json_encode($objDeportes);
    $conexion->close();
    echo $salidaJSON;
}

if($accion=="salidaVisita"){
    $inpID = $_GET['id'];
    $sql = "SELECT * FROM gimnasio WHERE ID = ".$inpID;
    $resultado=$conexion->query($sql);
    if($resultado==false){error("lectura");}

    $fila=$resultado->fetch_assoc();
    $objVisita=new stdClass();
    $objVisita->ID=$fila['ID'];
    $objVisita->Nombre=$fila['Nombre'];
    $objVisita->Apellido=$fila['Apellido'];
    $objVisita->Actividad=$fila['Actividad'];
    $objVisita->Fecha=$fila['Fecha'];

    $salidaJSON=json_encode($objVisita);
    $conexion->close();
    echo $salidaJSON;
}

if($accion=="salidaVisitas"){
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

    $resultado=$conexion->query($sql);
    if($resultado==false){error("lectura");}
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