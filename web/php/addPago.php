<?php 
session_start();
include '../php/bd.php';
if (!isset($_SESSION['usuario'])){
    ?>
    <script src='//cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <body>
      <script>
      Swal.fire({
          icon: 'error',
          title: '¡ERROR!',
          text: 'Debe inniciar sesión para añadir productos al carrito.'
      }).then(function() {
          window.location.href = "/kartun/web/index.php";
      });
      </script>
  </body>
  <?php
    exit(0);
    }else{
        
        $idCarrito = $_POST['cartShop'];        
        $tipoPago = $_POST['slcPago'];
        $numOperacion = $_POST['nOpe'];
        $titular = $_POST['titPago'];
        $tiempo = $_POST['fecha'];
        $pago = $_POST['ttlpg'];
        $descuento = $_POST['dscttl'];
        $envio = $_POST['dlvry'];
        $estado = 'PENDIENTE';

        $monto = $pago + $envio - $descuento;

        $data = "INSERT INTO pedido (`fecha`, `monto`, `tipPago`, `nroOpe`, `titular`, `estado`, `carritoId`) VALUES ('$tiempo', '$monto', '$tipoPago', '$numOperacion', '$titular', '$estado', '$idCarrito')";
        $resultado = mysqli_query($conexion, $data) or die("Error con el nuevo registro.");
        $sql = "UPDATE carrito SET `autorizado` = false WHERE `idCarrito` = '$idCarrito'";
        $resultado = mysqli_query($conexion, $sql) or die("Error con el nuevo registro.");
        mysqli_close($conexion);
    }
    
?>