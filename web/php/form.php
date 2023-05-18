<?php
$para = 'prueba@tecware.pro';
$nombre = $_POST['nom'];
$correo = $_POST['correo'];
$celular = $_POST['cel'];
$categoria = $_POST['categ'];
$articulo = $_POST['arti'];
$cantidad = $_POST['cant'];
$departamento = $_POST['depar'];
$provincia = $_POST['provi'];
$distrito = $_POST['dist'];
$pago = $_POST['pago'];

$mail ="
    Nombre Completo:".$nombre."
    Correo:".$correo."
    Celular:".$celular."
    Artículo:".$categoria."
    Modelo:".$articulo."
    Cantidad:".$cantidad."
    Departamento:".$departamento."
    Provincia:".$provincia."
    Distrito:".$distrito."
    Método de Pago:".$pago."
";

if(mail($para, $nombre, $mail)){ ?>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <body>
        <script>
            Swal.fire({
                icon: 'success',
                title: '¡CORRÉO ENVIADO!',
                text: 'Hemos recibido su correo. Nos pondremos en contacto muy pronto.'
            }).then(function() {
              window.location.href = "https://kartunpe.com/";
          });
        </script>
    </body>
<?php
    header("Location: https://kartunpe.com/");
    die();
}
?>