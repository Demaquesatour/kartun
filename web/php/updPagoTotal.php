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
?>
    <div class="tx-ttl">
        <h3>DELIVERY:</h3>
        <p id="deliver">-</p>
    </div>
    <div class="tx-ttl finalPrice">
        <h3>TOTAL:</h3>
        <p id="totalPagar">-</p>
    </div>
</div>