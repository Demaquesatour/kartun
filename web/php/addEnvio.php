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
        $tipoEnt = $_POST['slcEnt'];
        $delivery = $_POST['dlvr'];
        $departamento = $_POST['slcDep'];
        $provincia = $_POST['slcPro'];
        $distrito = $_POST['slcDis'];
        $direccion = $_POST['dir'];
        $referencia = $_POST['ref'];

        $data = mysqli_query($conexion,"INSERT INTO envio (`tipEnt`, `delivery`, `dep`, `prov`, `dist`, `dir`, `ref`, `carritoId`) VALUES ('$tipoEnt', '$delivery', '$departamento', '$provincia', '$distrito', '$direccion', '$referencia', '$idCarrito')");
        $resultado = mysqli_query($conexion, $consulta) or die("Error con el nuevo registro.");

        mysqli_close($conexion);
    }
    ?>