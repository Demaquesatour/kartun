<?php 
    include 'php/bd.php';
    include 'php/barra.php';
    if (!isset($_SESSION['usuario'])){
        header("Location:/admin/php/login.php");
        exit(0);
    }
?>