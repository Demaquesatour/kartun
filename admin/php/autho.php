<?php
include 'bd.php';

$usuario = $_POST['usuario'];
$clave = $_POST['clave'];
session_start();
$_SESSION['usuario'] = $usuario;

$consulta = "SELECT * FROM usuario where usuario = '$usuario' and clave = '$clave'";
$resultado = mysqli_query($conexion,$consulta);

$filas = mysqli_num_rows($resultado);

if ($filas) {
    header("location:../categoria.php");
} else {
    include("login.php");
    ?>
    <body>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11">
        Swal.fire({
            icon: 'error',
            title: 'ERROR',
            text: '¡Las credenciales no son correctas!',
            confirmButtonColor: '#0d44c9'
        });
        </script>
    </body>
    <?php
    header("location:login.php");
}
mysqli_free_result($resultado);
mysqli_close($conexion);