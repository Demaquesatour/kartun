<?php
    include './bd.php';

    $ID = $_POST['idstd'];
    $ESTADO = $_POST['stdCart'];
    $CARRITO = $_POST['idshop'];

    $consulta = "UPDATE pedido SET `estado` = '$ESTADO' WHERE `idPedido` = '$ID'";
    $resultado = mysqli_query($conexion,$consulta)or die("Error al actualizar");

    $consultaCarrito = "SELECT cant, productoId FROM detalle_carrito WHERE `carritoId` = '$CARRITO'";
    $result = mysqli_query($conexion, $consultaCarrito)or die("Error al actualizar");
    $existeProducto = mysqli_num_rows($result);        
    if ($existeProducto > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $cantidad = $row["cant"];
            $productoId = $row["productoId"];
    
            // Consulta de actualización para cada producto
            if ($ESTADO == 'ACEPTADO') {
                $updateSql = "UPDATE producto SET cantidad = cantidad - '$cantidad' WHERE idProducto = '$productoId'";
                $resuelto = mysqli_query($conexion, $updateSql)or die("Error al actualizar");
            }
        }
    } else {
        echo "No se encontraron resultados para el carritoId: $carritoId";
    }
    mysqli_close($conexion);
?>