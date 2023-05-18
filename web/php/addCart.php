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
        $idCliente = $_SESSION['idCliente'];
        $idProducto = $_POST['prdId'];
        $idCategoria = $_POST['prdCat'];
        $talla = $_POST['prdTalla'];
        $cantidad = $_POST['prdCant'];
        $precio = $_POST['prdPre'];
        $descuento = ($_POST['prdPre'] * $cantidad) - ($_POST['dscnt'] * $cantidad);
        $fecha = date('y-m-d H:i:s');
        $precioCantidad = (floatval($_POST['prdPre'])) * $_POST['prdCant'];

        $data = mysqli_query($conexion,"SELECT * from carrito WHERE `clienteId` = '$idCliente' AND `autorizado` = true");
        $existe = mysqli_num_rows($data);

        //Si no existe el carrito crea un carrito
        if($existe == 0){
            $consulta = "INSERT INTO carrito (`fecha`, `clienteId`, `autorizado`) VALUES ('$fecha', '$idCliente', true)";
            $resultado = mysqli_query($conexion, $consulta) or die("Error con el nuevo registro.");
            $idPedido = mysqli_insert_id($conexion);

            if(!isset($talla)){
                $consulta = "INSERT INTO detalle_carrito (`carritoId`, `productoId`, `cant`, `subprecio`, `descuento`) VALUES ('$idPedido', '$idProducto', '$cantidad', '$precioCantidad', '$descuento')";
                $resultado = mysqli_query($conexion, $consulta) or die("Error con el nuevo registro.");
            }else{
                $consulta = "INSERT INTO detalle_carrito (`carritoId`, `productoId`, `variante`, `cant`, `subprecio`, `descuento`) VALUES ('$idPedido', '$idProducto', '$talla', '$cantidad', '$precioCantidad', '$descuento')";
                $resultado = mysqli_query($conexion, $consulta) or die("Error con el nuevo registro.");
            }
        //Pero si existe, agrega productos al carrito existente
        } else if ($existe != 0) {
            while($carrito = mysqli_fetch_assoc($data)){
                $shop = $carrito['idCarrito'];
                //Si el producto no tiene talla
                if (!isset($talla)) {
                    // Verificar si el producto ya existe en detalle_carrito para este carrito
                    $consultaExistencia = "SELECT * FROM detalle_carrito WHERE `carritoId` = '$shop' AND `productoId` = '$idProducto' AND `variante` IS NULL";
                    $resultadoExistencia = mysqli_query($conexion, $consultaExistencia);
                    $existeProducto = mysqli_num_rows($resultadoExistencia);        
                    if ($existeProducto > 0) {
                        // Verificar que la cantidad total no exceda las 12 unidades
                        $consultaCantidadTotal = "SELECT cant FROM detalle_carrito WHERE `carritoId` = '$shop' AND `productoId` = '$idProducto'";
                        $resultadoCantidadTotal = mysqli_query($conexion, $consultaCantidadTotal) or die("Error al obtener la cantidad total del producto.");
                        $cantidadTotal = mysqli_fetch_assoc($resultadoCantidadTotal)['cant'];

                        if (($cantidadTotal + $cantidad) > 12) {
                            die("Error: La cantidad total del producto no puede ser mayor a 12 unidades.");
                        } else {
                            // Actualizar la cantidad del producto, el precio y el descuento existente en detalle_carrito
                            $consultaUpdateCantidad = "UPDATE detalle_carrito SET `cant` = `cant` + '$cantidad', `subprecio` = `subprecio` + '$precioCantidad', `descuento` = `descuento` + '$descuento'  WHERE `carritoId` = '$shop' AND `productoId` = '$idProducto' AND `variante` IS NULL";
                            $resultadoUpdateCantidad = mysqli_query($conexion, $consultaUpdateCantidad) or die("Error al actualizar en el producto existente.");

                            // Obtener el descuento del producto existente
                            $consultaCantidadExistente = "SELECT cant FROM detalle_carrito WHERE `carritoId` = '$shop' AND `productoId` = '$idProducto' AND `variante` IS NULL";
                            $resultadoCantidadExistente = mysqli_query($conexion, $consultaDescuentoExistente) or die("Error al obtener el descuento del producto existente.");
                            $cantidadExistente = mysqli_fetch_assoc($resultadoDescuentoExistente)['cant'];

                            // Determinar el descuento correspondiente a la cantidad
                            $consultaDescuento = "SELECT descuento FROM descuento WHERE `categoriaId` = '$idCategoria' AND `cantidad` = '$cantidadExistente'";
                            $resultadoDescuentoExistente = mysqli_query($conexion, $consultaDescuento);
                            $existeDescuento = mysqli_num_rows($resultadoDescuentoExistente);
                            if ($existeDescuento > 0){
                                $descuentoExiste = mysqli_fetch_assoc($resultadoDescuentoExistente)['descuento'];
                                $calcularDescuento = $precio - ($precio * ($descuentoExiste/100));
                                $descuentoTotal = ($precio * $cantidadExistente) - ($cantidadExistente * $calcularDescuento);
                                $consultaUpdateDescuento = "UPDATE detalle_carrito SET `descuento` = '$descuentoTotal' WHERE `carritoId` = '$shop' AND `productoId` = '$idProducto' AND `variante` IS NULL";
                                $resultadoUpdateDescuento = mysqli_query($conexion, $consultaUpdateDescuento) or die("Error al actualizar en el producto existente.");
                            } else {
                                $ultimoDescuento = "SELECT descuento FROM descuento WHERE `categoriaId` = '$idCategoria' ORDER BY idDescuento DESC LIMIT 1";
                                $resultadoUltimoDescuento = mysqli_query($conexion, $ultimoDescuento) or die("Error al obtener el descuento del producto existente.");
                                $ultimoDescuentoExistente = mysqli_fetch_assoc($resultadoUltimoDescuento)['descuento'];
                                $calcularDescuentoExistente= $precio - ($precio * ($ultimoDescuentoExistente/100));
                                $descuentoTotalExistente = ($precio * $cantidadExistente) - ($cantidadExistente * $calcularDescuentoExistente);
                                $consultaUpdateUltimoDescuento = "UPDATE detalle_carrito SET `descuento` = '$descuentoTotalExistente' WHERE `carritoId` = '$shop' AND `productoId` = '$idProducto' AND `variante` IS NULL";
                                $resultadoUpdateUltimoDescuento = mysqli_query($conexion, $consultaUpdateUltimoDescuento) or die("Error al actualizar en el producto existente.");
                            }
                        }
                    } else {
                        // Insertar un nuevo registro en detalle_carrito
                        $consultaInsertar = "INSERT INTO detalle_carrito (`carritoId`, `productoId`, `cant`, `subprecio`, `descuento`) VALUES ('$shop', '$idProducto', '$cantidad', '$precioCantidad', '$descuento')";
                        $resultadoInsertar = mysqli_query($conexion, $consultaInsertar) or die("Error al insertar el nuevo producto en detalle_carrito.");
                    }
                //En cambio si el producto tiene talla
                }else{
                   // Verificar si el producto con variante ya existe en detalle_carrito para este carrito
                    $consultaExistencia = "SELECT * FROM detalle_carrito WHERE `carritoId` = '$shop' AND `productoId` = '$idProducto' AND `variante` = '$talla'";
                    $resultadoExistencia = mysqli_query($conexion, $consultaExistencia);
                    $existeProducto = mysqli_num_rows($resultadoExistencia);
                    if ($existeProducto > 0) {
                        // Verificar que la cantidad total no exceda las 12 unidades
                        $consultaCantidadTotal = "SELECT cant FROM detalle_carrito WHERE `carritoId` = '$shop' AND `productoId` = '$idProducto'";
                        $resultadoCantidadTotal = mysqli_query($conexion, $consultaCantidadTotal) or die("Error al obtener la cantidad total del producto.");
                        $cantidadTotal = mysqli_fetch_assoc($resultadoCantidadTotal)['cant'];

                        if (($cantidadTotal + $cantidad) > 12) {
                            die("Error: La cantidad total del producto no puede ser mayor a 12 unidades.");
                        } else {
                            // Actualizar la cantidad del producto, el precio y el descuento existente en detalle_carrito
                            $consultaUpdateCantidad = "UPDATE detalle_carrito SET `cant` = `cant` + '$cantidad', `subprecio` = `subprecio` + '$precioCantidad' WHERE `carritoId` = '$shop' AND `productoId` = '$idProducto' AND `variante` = '$talla'";
                            $resultadoUpdateCantidad = mysqli_query($conexion, $consultaUpdateCantidad) or die("Error al actualizar en el producto existente.");

                            // Obtener el descuento del producto existente
                            $consultaCantidadExistente = "SELECT cant FROM detalle_carrito WHERE `carritoId` = '$shop' AND `productoId` = '$idProducto' AND `variante` = '$talla'";
                            $resultadoCantidadExistente = mysqli_query($conexion, $consultaCantidadExistente) or die("Error al obtener el descuento del producto existente.");
                            $cantidadExistente = mysqli_fetch_assoc($resultadoCantidadExistente)['cant'];

                            // Determinar el descuento correspondiente a la cantidad
                            $consultaDescuento = "SELECT descuento FROM descuento WHERE `categoriaId` = '$idCategoria' AND `cantidad` = '$cantidadExistente'";
                            $resultadoDescuentoExistente = mysqli_query($conexion, $consultaDescuento);
                            $existeDescuento = mysqli_num_rows($resultadoDescuentoExistente);
                            if ($existeDescuento > 0){
                                $descuentoExiste = mysqli_fetch_assoc($resultadoDescuentoExistente)['descuento'];
                                $calcularDescuento = $precio - ($precio * ($descuentoExiste/100));
                                $descuentoTotal = ($precio * $cantidadExistente) - ($cantidadExistente * $calcularDescuento);
                                $consultaUpdateDescuento = "UPDATE detalle_carrito SET `descuento` = '$descuentoTotal' WHERE `carritoId` = '$shop' AND `productoId` = '$idProducto' AND `variante` = '$talla'";
                                $resultadoUpdateDescuento = mysqli_query($conexion, $consultaUpdateDescuento) or die("Error al actualizar en el producto existente.");
                            } else {
                                $ultimoDescuento = "SELECT descuento FROM descuento WHERE `categoriaId` = '$idCategoria' ORDER BY idDescuento DESC LIMIT 1";
                                $resultadoUltimoDescuento = mysqli_query($conexion, $ultimoDescuento) or die("Error al obtener el descuento del producto existente.");
                                $ultimoDescuentoExistente = mysqli_fetch_assoc($resultadoUltimoDescuento)['descuento'];
                                $calcularDescuentoExistente= $precio - ($precio * ($ultimoDescuentoExistente/100));
                                $descuentoTotalExistente = ($precio * $cantidadExistente) - ($cantidadExistente * $calcularDescuentoExistente);
                                $consultaUpdateUltimoDescuento = "UPDATE detalle_carrito SET `descuento` = '$descuentoTotalExistente' WHERE `carritoId` = '$shop' AND `productoId` = '$idProducto' AND `variante`  = '$talla'";
                                $resultadoUpdateUltimoDescuento = mysqli_query($conexion, $consultaUpdateUltimoDescuento) or die("Error al actualizar en el producto existente.");
                            }
                        }
                    } else {
                        // Insertar un nuevo registro en detalle_carrito
                        $consultaInsertar = "INSERT INTO detalle_carrito (`carritoId`, `productoId`, `variante`, `cant`, `subprecio`, `descuento`) VALUES ('$shop', '$idProducto', '$talla', '$cantidad', '$precioCantidad', '$descuento')";
                        $resultadoInsertar = mysqli_query($conexion, $consultaInsertar) or die("Error al insertar el nuevo producto con variante en detalle_carrito.");
                    }
                }
                mysqli_close($conexion);
            }
        }
    }    
?>