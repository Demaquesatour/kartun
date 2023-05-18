<?php
    include './php/bd.php';

    $ID = $_POST['editId'];
    $NOMBRE = $_POST['editNombre'];
    $CORREO = $_POST['editCorreo'];
    $USUARIO = $_POST['editUsuario'];
    $CLAVE = $_POST['editClave'];

    mysqli_query($conexion,"UPDATE usuario SET `nombre` = '$NOMBRE', `correo` = '$CORREO', `usuario` = '$USUARIO', `clave` ='$CLAVE' WHERE `idUsuario` = '$ID'")or die("Error al actualizar");
    mysqli_close($conexion);
    header("location:admin.php");
?>