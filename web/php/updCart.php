<?php 
session_start();
include './bd.php';

$id = $_SESSION['idCliente'];
$consulta = "SELECT COUNT(*) as Cantidad FROM carrito c INNER JOIN detalle_carrito d ON c.idCarrito = d.carritoId WHERE clienteId = '$id' AND c.autorizado = true";
$resultado = mysqli_query($conexion, $consulta);
while($mostrar = mysqli_fetch_array($resultado)){
 echo $mostrar['Cantidad'];
    }
mysqli_close($conexion);
?>