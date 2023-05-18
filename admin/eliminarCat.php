<?php
    include 'php/bd.php';

    $id = $_GET['id'];
    mysqli_query($conexion, "DELETE FROM categoria WHERE idCategoria = $id")or die("Error al eliminar el registro.");

    mysqli_close($conexion);
    header("location:categoria.php");

?>