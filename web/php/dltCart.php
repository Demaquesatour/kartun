<?php
    session_start();
    include './bd.php';

    if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
        $idDetCarrito = $_GET['id'];
      
        // Ejecutar la sentencia SQL DELETE
        $sentencia = mysqli_prepare($conexion, 'DELETE FROM detalle_carrito WHERE idDetalleCarrito = ?');
        mysqli_stmt_bind_param($sentencia, 'i', $idDetCarrito);
        $resultado = mysqli_stmt_execute($sentencia);
        mysqli_stmt_close($sentencia);
        
        // Verificar si se eliminó el detalle del carrito correctamente
        if ($resultado) {
          http_response_code(200);
          echo 'Detalle del carrito eliminado correctamente';
        } else {
          http_response_code(500);
          echo 'Error al eliminar el detalle del carrito: ' . mysqli_error($conexion);
        } 
        
        mysqli_close($conexion);
      } else {
        http_response_code(405);
        echo 'Método no permitido';
    }
?>