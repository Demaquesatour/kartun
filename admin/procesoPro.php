<?php
    include 'php/bd.php';

    if(isset($_REQUEST['updImg'])){
        $nombreFoto = $_FILES['editFoto']['name'];
        $tempNombre = $_FILES['editFoto']['tmp_name'];
        $carpeta = 'img/imgProducto';
        $ruta = $carpeta.'/'.$nombreFoto;
        move_uploaded_file($tempNombre,$carpeta.'/'.$nombreFoto);

        $ID = $_POST['editId'];
        $PRODUCTO = $_POST['editProducto'];
        $RUTA = $ruta;
        $RUTAOLD = $_POST['rutaOld'];
        $PRECIO = $_POST['editPrecio'];
        $CATEGORIA = $_POST['editCategoria'];
        $DETALLE = $_POST['editDetalle'];
        $CANTIDAD = $_POST['editCantidad'];

        if(!empty($nombreFoto)){
            unlink($RUTAOLD);
            $nomCat = "SELECT categoria FROM categoria WHERE `idCategoria` = '$CATEGORIA'";
            $resCat = mysqli_query($conexion, $nomCat) or die("Error al obtener el descuento del producto existente.");
            $cate = mysqli_fetch_assoc($resCat)['categoria'];
            mysqli_query($conexion,"UPDATE producto SET `enlace` = '$RUTA', `producto` = '$PRODUCTO', `precio` = '$PRECIO', `cantidad` = '$CANTIDAD', `catProducto` = '$cate', `detalle` = '$DETALLE', `categoriaId` = '$CATEGORIA' WHERE `idProducto` = '$ID'")or die("Error al actualizar");
            mysqli_close($conexion);
            header("location:producto.php");
        } else{
            $nomCat = "SELECT categoria FROM categoria WHERE `idCategoria` = '$CATEGORIA'";
            $resCat = mysqli_query($conexion, $nomCat) or die("Error al obtener el descuento del producto existente.");
            $cate = mysqli_fetch_assoc($resCat)['categoria'];
            mysqli_query($conexion,"UPDATE producto SET `enlace` = '$RUTAOLD', `producto` = '$PRODUCTO', `precio` = '$PRECIO', `cantidad` = '$CANTIDAD', `catProducto` = '$cate', `detalle` = '$DETALLE', `categoriaId` = '$CATEGORIA' WHERE `idProducto` = '$ID'")or die("Error al actualizar");
            mysqli_close($conexion);
            header("location:producto.php");
        }
    }

?>