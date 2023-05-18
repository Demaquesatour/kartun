<?php
session_start();
include './bd.php';

$id = $_SESSION['idCliente'];
$sql = "SELECT * FROM detalle_carrito d INNER JOIN carrito c ON d.carritoId = c.idCarrito INNER JOIN producto p ON d.productoId = p.idProducto WHERE c.clienteId = '$id' AND c.autorizado = true";
$result = mysqli_query($conexion, $sql);
foreach ($result as $rs):
?>
<div class="crt-prd">
    <div class="prd-inf">
        <div class="prd-img">
            <img src="/kartun/admin/<?php echo $rs['enlace'];?>" alt="">
        </div>
        <div class="prd-dt">
            <h3><?php echo $rs['producto'];?></h3>
        <?php
            $proID = $rs['idProducto'];
            $sql = "SELECT * FROM variante where productoId  = '$proID'";
            $result = mysqli_query($conexion,$sql);
            if (mysqli_num_rows($result) > 0) {
        ?>
            <div class="prd-txt">
            <h4>TALLA:</h4>
            <p><?php echo $rs['variante'];?></p>
            </div>
            <div class="prd-txt">
                <h4>CANTIDAD:</h4>
                <p><?php echo $rs['cant'];?></p>
            </div>
            <div class="prd-txt">
                <h4>PRECIO:</h4>
                <p>S/ <?php echo $rs['subprecio'];?></p>
            </div>
        <?php }else{ ?>
            <div class="prd-txt">
                <h4>CANTIDAD:</h4>
                <p><?php echo $rs['cant'];?></p>
            </div>
            <div class="prd-txt">
                <h4>PRECIO:</h4>
                <p>S/ <?php echo $rs['subprecio'];?></p>
            </div>
        <?php } ?>                        
        </div>
    </div>
    <div class="prd-xt">
        <i class='bx bx-x eliProducto' data-id="<?php echo $rs['idDetalleCarrito']; ?>"></i>
    </div>
</div>
<?php endforeach ?>
<?php mysqli_close($conexion); ?>