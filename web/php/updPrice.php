<?php
 session_start();
 include './bd.php';
 $id = $_SESSION['idCliente'];

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $sql = "SELECT SUM(subprecio) as 'total' FROM detalle_carrito d INNER JOIN carrito c ON d.carritoId = c.idCarrito WHERE c.clienteId = '$id' AND c.autorizado = true";
    $total = mysqli_query($conexion, $sql);
    $data = mysqli_fetch_array($total);
    echo $data['total'];
  } else {
    http_response_code(405);
    echo 'Método no permitido';
}
mysqli_close($conexion);
?>