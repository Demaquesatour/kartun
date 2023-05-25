<?php
    include 'php/bd.php';

    $id = $_POST['idnt'];

    mysqli_query($conexion, "DELETE FROM variante WHERE idVariante = $id")or die("Error al eliminar el registro.");
    mysqli_close($conexion);
?>