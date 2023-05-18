<?php
include 'php/bd.php';

$cantidad = $_POST['canDesc'];
$descuento = $_POST['desDesc'];
$categoria = $_POST['catName'];
$idCat = $_POST['cateId'];

$consulta = "INSERT INTO descuento (`cantidad`, `descuento`, `categoria` ,`categoriaId`) VALUES ('$cantidad', '$descuento', '$categoria', '$idCat')";
$resultado= mysqli_query($conexion, $consulta) or die("Error con el nuevo registro.");
header("location:descuento.php?id=".$idCat);
mysqli_close($conexion);
?>