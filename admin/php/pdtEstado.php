<?php
    include './bd.php';

    $ID = $_POST['idstd'];
    $ESTADO = $_POST['stdCart'];

    $consulta = "UPDATE pedido SET `estado` = '$ESTADO' WHERE `idPedido` = '$ID'";
    $resultaod = mysqli_query($conexion,$consulta)or die("Error al actualizar");
    mysqli_close($conexion);
?>