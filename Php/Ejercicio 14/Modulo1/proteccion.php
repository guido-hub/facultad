<?php
session_start();
if(!isset($_SESSION['IdDeSesion'])){
    header('location:../index.php');
    exit();
    }
?>