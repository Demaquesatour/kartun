<?php
include 'php/bd.php';

$nombre = $_POST['catNom'];

$consulta = "INSERT INTO categoria (`categoria`) VALUES ('$nombre')";
$resultado= mysqli_query($conexion, $consulta) or die("Error con el nuevo registro.");
header("location:categoria.php");
mysqli_close($conexion);
?>