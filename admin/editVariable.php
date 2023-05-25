<?php 
    include './php/bd.php';

    $id = $_POST['idnt'];
    $valor = $_POST['vlr'];

    if(isset($id) && isset($valor)){
        $consulta = "UPDATE variante SET `descripcion` = '$valor' WHERE `idVariante` = '$id'";
        $resultado= mysqli_query($conexion, $consulta) or die("Error con el nuevo producto.");
    }
    
    mysqli_close($conexion);
?>