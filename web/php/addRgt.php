<?php 
session_start();
include './bd.php';

    $usuario = mysqli_real_escape_string($conexion, $_POST['agrusu']);
    $nombre = mysqli_real_escape_string($conexion, $_POST['agrnom']);
    $clave = mysqli_real_escape_string($conexion, $_POST['agrclave']);
    $clave2 = mysqli_real_escape_string($conexion, $_POST['agrclave2']);
    $correo = mysqli_real_escape_string($conexion, $_POST['agrmail']);

    $ncrpt = password_hash($clave, PASSWORD_DEFAULT, ['cost' => 10]);



    $mailPrueba = '';

    $consulta = "SELECT * FROM cliente WHERE `mail` = '$correo'";
    $resultado = mysqli_query($conexion, $consulta) or die ("Error con el nuevo registro");
    foreach ($resultado as $rs){
        $mailPrueba = $rs['mail'];
    }

    if($mailPrueba == $correo){
        ?>
        <script src='//cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <body>
          <script>
          Swal.fire({
              icon: 'error',
              title: '¡ERROR!',
              text: '¡El correo ya se encuentra registrado! Por favor verifique su cuenta.'
          });
          </script>
        </body>
      <?php
      include '../index.php';
    } else {
        if($clave === $clave2){
            $consulta = "INSERT INTO cliente (`usuario`,`nombre`,`pass`,`mail`) VALUES ('$usuario','$nombre','$ncrpt','$correo')";
            $resultado = mysqli_query($conexion, $consulta) or die ("Error con el nuevo registro");
            ?>
            <script src='//cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            <body>
                <script>
                Swal.fire({
                    icon: 'success',
                    title: '¡CUENTA CREADA!',
                    text: '¡Su cuenta se creó correctamente! Por favor inicie sesión para continuar.'
                }).then(function() {
                    window.location.href = "/kartun/web/index.php";
                });
                </script>
            </body>
            <?php
            // header("location:/kartun/web/index.php");
            mysqli_close($conexion);
        } else{
            ?>
            <script src='//cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            <body>
                <script>
                Swal.fire({
                    icon: 'error',
                    title: '¡ERROR!',
                    text: '¡Las claves no son iguales! Por favor verifique su contraseña.'
                }).then(function() {
                    window.location.href = "/kartun/web/index.php";
                });
                </script>
            </body>
            <?php
        }
    }

?>