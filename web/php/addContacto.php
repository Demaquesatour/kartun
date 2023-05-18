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
        $tipoDoc = $_POST['slcDoc'];
        $documento = $_POST['numDoc'];
        $nombre = $_POST['nomCon'];
        $celular = $_POST['celCon'];

        $data = mysqli_query($conexion,"INSERT INTO contacto (`tipDoc`, `numDoc`, `nombre`, `telefonoContacto`, `carritoId`) VALUES ('$tipoDoc', '$documento', '$nombre', '$celular', '$idCarrito')");
        $resultado = mysqli_query($conexion, $consulta) or die("Error con el nuevo registro.");

        mysqli_close($conexion);
    }
    
?>