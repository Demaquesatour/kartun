<?php
include 'php/bd.php';

$nombre = $_POST['varNom'];
$idPro = $_POST['idProducto'];

$consulta = "INSERT INTO variante (`descripcion`, `productoId`) VALUES ('$nombre', '$idPro')";
$resultado= mysqli_query($conexion, $consulta) or die("Error con el nuevo registro.");
header("location:variante.php?id=".$idPro);
mysqli_close($conexion);
?>