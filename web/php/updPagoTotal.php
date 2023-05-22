<?php 
    session_start();
    include './bd.php';
    $id = $_SESSION['idCliente'];

    $sql2 ="SELECT SUM(subprecio) as 'total' FROM detalle_carrito d INNER JOIN carrito c ON d.carritoId = c.idCarrito WHERE c.clienteId = '$id' AND c.autorizado = true";
    $total = mysqli_query($conexion, $sql2);
    while($data = mysqli_fetch_array($total)){ 
?>
<div class="sb-txs">
    <div class="tx-ttl">
        <h3>SUBTOTAL:</h3>
        <p id="subTotalPago">S/ <?php echo $data['total']; ?></p>
    </div>
<?php 
} 
    $sql3 ="SELECT SUM(descuento) as 'desctotal' FROM detalle_carrito d INNER JOIN carrito c ON d.carritoId = c.idCarrito WHERE c.clienteId = '$id' AND c.autorizado = true";
    $desctotal = mysqli_query($conexion, $sql3);
    while($dt = mysqli_fetch_array($desctotal)){ 
?>
    <div class="tx-ttl dsc">
        <h3>DESCUENTO:</h3>
        <p id="descTotal">S/ <?php echo $dt['desctotal']; ?></p>
    </div>
<?php 
}
    $sql4 ="SELECT delivery FROM envio e INNER JOIN carrito c ON e.carritoId = c.idCarrito WHERE c.clienteId = '$id' AND c.autorizado = true";
    $resultadoEnvio = mysqli_query($conexion, $sql4);
    $existeEnvio = mysqli_num_rows($resultadoEnvio);
    if($existeEnvio > 0){ 
        $deliveryExiste = mysqli_fetch_assoc($resultadoEnvio)['delivery'];
?>
    <div class="tx-ttl">
        <h3>DELIVERY:</h3>
        <p id="deliver">S/ <?php echo $deliveryExiste ?></p>
    </div>
<?php } else { ?>
    <div class="tx-ttl">
        <h3>DELIVERY:</h3>
        <p id="deliver">-</p>
    </div>
<?php 
    } 
?>
    <div class="tx-ttl finalPrice">
        <h3>TOTAL:</h3>
        <p id="totalPagar">-</p>
    </div>
</div>