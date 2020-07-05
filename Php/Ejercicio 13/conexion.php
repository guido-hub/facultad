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
?>