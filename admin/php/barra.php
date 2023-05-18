<?php
    session_start();
    if(!isset($_SESSION['usuario'])){
        header("Location:login.php");
        exit(0);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <script src='//cdn.jsdelivr.net/npm/sweetalert2@11'></script>
</head>
<body>
    <div class="fcc c-base">
        <div class="c-menu">
            <div class="fcc c-img">
                <img src="img/logo.png" alt="">
            </div>
            <div class="fcsc c-enlace">
                <a href="categoria.php">Categoría</a>
                <a href="producto.php">Producto</a>
                <a href="delivery.php">Delivery</a>
                <a href="carrito.php">Carrito</a>
            </div>
            <div class="fsc c-usuario">
                <p><?php echo $_SESSION['usuario']; ?></p>
                <a href="./php/logout.php"><i class='bx bx-exit'></i></a>
            </div>
        </div>