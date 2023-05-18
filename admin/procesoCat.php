<?php
    include './php/bd.php';

    $ID = $_POST['editId'];
    $NOMBRE = $_POST['editNombre'];

    mysqli_query($conexion,"UPDATE categoria SET `categoria` = '$NOMBRE' WHERE `idCategoria` = '$ID'")or die("Error al actualizar");
    mysqli_close($conexion);
    header("location:categoria.php");
?>