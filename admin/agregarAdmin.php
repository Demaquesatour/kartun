<?php
include 'php/bd.php';

$nombre = $_POST['admNom'];
$usuario = $_POST['admUsu'];
$clave = $_POST['admCla'];
$correo = $_POST['admCo'];

$consulta = "INSERT INTO usuario (`nombre`, `correo`, `usuario`, `clave`) VALUES ('$nombre','$correo','$usuario','$clave')";
$resultado= mysqli_query($conexion, $consulta) or die("Error con el nuevo registro.");
header("location:admin.php");
mysqli_close($conexion);
?>