<?php
    include 'php/bd.php';

    $id = $_GET['id'];
    mysqli_query($conexion, "DELETE FROM producto WHERE idProducto = $id")or die("Error al eliminar el registro.");

    mysqli_close($conexion);
    header("location:producto.php");

?>