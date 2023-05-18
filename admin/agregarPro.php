<?php
include 'php/bd.php';

    if(isset($_REQUEST['crearPro'])){

        $nombreFoto = $_FILES['proFoto']['name'];
        $tempNombre = $_FILES['proFoto']['tmp_name'];
        $carpeta = 'img/imgProducto';
        $ruta = $carpeta.'/'.$nombreFoto;
        move_uploaded_file($tempNombre,$carpeta.'/'.$nombreFoto);
        $titulo = $_POST['proNom'];
        $precio = $_POST['proPrecio'];
        $cantidad = $_POST['proCantidad'];
        $idcategoria = $_POST['proCategoria'];
        $detalle = $_POST['proDetalle'];
        if(!empty($nombreFoto)){
            $nomCat = "SELECT categoria FROM categoria WHERE `idCategoria` = '$idcategoria'";
            $resCat = mysqli_query($conexion, $nomCat) or die("Error al obtener el descuento del producto existente.");
            $categoria = mysqli_fetch_assoc($resCat)['categoria'];
            $consulta = "INSERT INTO producto (`enlace`, `producto`, `precio`, `cantidad`,`catProducto`, `detalle`, `categoriaId`) VALUES ('$ruta', '$titulo', '$precio', '$cantidad', '$categoria', '$detalle', '$idcategoria')";
            $resultado= mysqli_query($conexion, $consulta) or die("Error con el nuevo producto.");
    
            if ($resultado) {
                header("location:producto.php");
            } else {
                echo "Hubo un error.";
            }
            mysqli_close($conexion);
        }else{
            ?>
            <script src='//cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            <body>
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: '¡ERROR!',
                        text: 'No puedes subir un producto sin imagen.'
                        }).then(function() {
                            window.location.href = "producto.php";
                        });
                </script>
            </body>
            <?php
        }
    }

?>