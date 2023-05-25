<?php 
    include './php/bd.php';

    $id = $_POST['dlvId'];
    $precio = $_POST['dlvPrc'];
    $estado = $_POST['dlvStt'];

    if(isset($precio) && isset($estado)){
        $consulta = "UPDATE departamentos SET `precio` = '$precio', `status` = '$estado' WHERE `idDepartamento` = '$id'";
        $resultado= mysqli_query($conexion, $consulta) or die("Error con el nuevo producto.");
    } else if (isset($precio)){
        $consulta = "UPDATE departamentos SET `precio` = '$precio' WHERE `idDepartamento` = '$id'";
        $resultado= mysqli_query($conexion, $consulta) or die("Error con el nuevo producto.");
    } else if (isset($estado)) {
        $consulta = "UPDATE departamentos SET `status` = '$estado' WHERE `idDepartamento` = '$id'";
        $resultado= mysqli_query($conexion, $consulta) or die("Error con el nuevo producto.");
    }
    
    mysqli_close($conexion);
?>