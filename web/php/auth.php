<?php
require './bd.php';

$usuario = mysqli_real_escape_string($conexion, $_POST['usuario']);
$clave = mysqli_real_escape_string($conexion, $_POST['clave']);

session_start();

$consulta = "SELECT * FROM cliente where usuario = '$usuario'";
$resultado = mysqli_query($conexion,$consulta);

$filas = mysqli_fetch_array($resultado);

$dataPass = $filas['pass'];

if(password_verify($clave, $dataPass)){
    $_SESSION['usuario'] = $filas['usuario'];
    $_SESSION['idCliente'] = $filas['idCliente'];
    header("location:/kartun/web/index.php");
} else{
    ?>
    <script src='//cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <body>
          <script>
          Swal.fire({
              icon: 'error',
              title: '¡ERROR!',
              text: '¡La contraseña es incorrecta!'
          }).then(function() {
                    window.location.href = "/kartun/web/index.php";
        });
          </script>
      </body>
    <?php
}
