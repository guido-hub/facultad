<?php
session_start();
if(!isset($_SESSION['IdDeSesion'])){
    header('location:./login.html');
    exit();
}
?>