<?php
    include 'php/bd.php';

    $id = $_GET['id'];
    mysqli_query($conexion, "DELETE FROM usuario WHERE idUsuario = $id")or die("Error al eliminar el registro.");

    mysqli_close($conexion);
    header("location:admin.php");

?>