<?php 
    include 'php/bd.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <script src='//cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <title>KARTUN</title>
</head>
<body>
    <div class="base">
        <!--WSP-->
        <?php include 'template/wsp.php'; ?>
        <!--MENU-->
        <?php include 'template/menu.php'; ?>
        <!--PANTALONES-->
        <div id="pants" class="model">
            <div class="title">
                <h1>PANTS</h1>
            </div>
            <?php 
                $sql = "SELECT * FROM producto where catProducto = 'Pantalones'";
                $result = mysqli_query($conexion,$sql);
            ?>
            <div class="model-pdt">
            <?php foreach ($result as $opt): ?>
                <a href="template/producto.php?id=<?php echo $opt['idProducto'];?>&cat=<?php echo $opt['catProducto'];?>"><div class="pdt">
                    <img src="/kartun/admin/<?php echo $opt['enlace'];?>" alt="">
                    <div class="detail">
                        <h2>TALLAS</h2>
                        <div class="medidas">
                        <?php 
                            $id = $opt['idProducto'];
                            $sql = "SELECT * FROM variante where productoId  = '$id'";
                            $result = mysqli_query($conexion,$sql);
                        ?>
                            <?php foreach ($result as $sz): ?>
                            <p><?php echo $sz['descripcion'];?></p>
                            <?php endforeach ?>
                        </div>
                    </div>
                    <div class="price">
                        <h1><?php echo $opt['producto'];?></h1>
                        <p>S/ <?php echo $opt['precio'];?></p>
                    </div>
                </div></a>
                <?php endforeach ?>
            </div>
        </div>
        <!--SHORT-->
        <div id="sh" class="model">
            <div class="title">
                <h1>SHORTS</h1>
            </div>
            <?php 
                $sql = "SELECT * FROM producto where catProducto = 'Shorts'";
                $result = mysqli_query($conexion,$sql);
            ?>
            <div class="model-pdt">
                <?php foreach ($result as $opt): ?>
                    <a href="template/producto.php?id=<?php echo $opt['idProducto'];?>&cat=<?php echo $opt['catProducto'];?>"><div class="pdt">
                    <img src="/kartun/admin/<?php echo $opt['enlace'];?>" alt="">
                    <div class="detail">
                        <h2>TALLAS</h2>
                        <div class="medidas">
                        <?php 
                            $id = $opt['idProducto'];
                            $sql = "SELECT * FROM variante where productoId  = '$id'";
                            $result = mysqli_query($conexion,$sql);
                        ?>
                            <?php foreach ($result as $sz): ?>
                            <p><?php echo $sz['descripcion'];?></p>
                            <?php endforeach ?>
                        </div>
                    </div>
                    <div class="price">
                        <h1><?php echo $opt['producto'];?></h1>
                        <p>S/ <?php echo $opt['precio'];?></p>
                    </div>
                </div></a>
                <?php endforeach ?>
            </div>
        </div>
        <!--MOCHILAS-->
        <div id="mo" class="model">
            <div class="title">
                <h1>MOCHILITAS</h1>
            </div>
            <?php 
                $sql = "SELECT * FROM producto where catProducto = 'Mochilitas'";
                $result = mysqli_query($conexion,$sql);
            ?>
            <div class="model-pdt">
            <?php foreach ($result as $opt): ?>
                <a href="template/producto.php?id=<?php echo $opt['idProducto'];?>&cat=<?php echo $opt['catProducto'];?>"><div class="pdt">
                    <img src="/kartun/admin/<?php echo $opt['enlace'];?>" alt="">
                    <div class="detail">
                        <h2>TALLAS</h2>
                        <div class="medidas">
                        <?php 
                            $id = $opt['idProducto'];
                            $sql = "SELECT * FROM variante where productoId  = '$id'";
                            $result = mysqli_query($conexion,$sql);
                        ?>
                            <?php foreach ($result as $sz): ?>
                            <p><?php echo $sz['descripcion'];?></p>
                            <?php endforeach ?>
                        </div>
                    </div>
                    <div class="price">
                        <h1><?php echo $opt['producto'];?></h1>
                        <p>S/ <?php echo $opt['precio'];?></p>
                    </div>
                </div></a>
                <?php endforeach ?>
            </div>
        </div>
        <!--POLOS-->
        <div id="mo" class="model">
            <div class="title">
                <h1>POLOS</h1>
            </div>
            <?php 
                $sql = "SELECT * FROM producto where catProducto = 'Polos'";
                $result = mysqli_query($conexion,$sql);
            ?>
            <div class="model-pdt">
            <?php foreach ($result as $opt): ?>
                <a href="template/producto.php?id=<?php echo $opt['idProducto'];?>&cat=<?php echo $opt['catProducto'];?>"><div class="pdt">
                    <img src="/kartun/admin/<?php echo $opt['enlace'];?>" alt="">
                    <div class="detail">
                        <h2>TALLAS</h2>
                        <div class="medidas">
                        <?php 
                            $id = $opt['idProducto'];
                            $sql = "SELECT * FROM variante where productoId  = '$id'";
                            $result = mysqli_query($conexion,$sql);
                        ?>
                            <?php foreach ($result as $sz): ?>
                            <p><?php echo $sz['descripcion'];?></p>
                            <?php endforeach ?>
                        </div>
                    </div>
                    <div class="price">
                        <h1><?php echo $opt['producto'];?></h1>
                        <p>S/ <?php echo $opt['precio'];?></p>
                    </div>
                </div></a>
                <?php endforeach ?>
            </div>
        </div>
        <!--POLERAS-->
        <div id="mo" class="model">
            <div class="title">
                <h1>POLERAS</h1>
            </div>
            <?php 
                $sql = "SELECT * FROM producto where catProducto = 'Poleras'";
                $result = mysqli_query($conexion,$sql);
            ?>
            <div class="model-pdt">
            <?php foreach ($result as $opt): ?>
                <a href="template/producto.php?id=<?php echo $opt['idProducto'];?>&cat=<?php echo $opt['catProducto'];?>">
                <div class="pdt">
                    <img src="/kartun/admin/<?php echo $opt['enlace'];?>" alt="">
                    <div class="detail">
                        <h2>TALLAS</h2>
                        <div class="medidas">
                        <?php 
                            $id = $opt['idProducto'];
                            $sql = "SELECT * FROM variante where productoId  = '$id'";
                            $result = mysqli_query($conexion,$sql);
                        ?>
                            <?php foreach ($result as $sz): ?>
                            <p><?php echo $sz['descripcion'];?></p>
                            <?php endforeach ?>
                        </div>
                    </div>
                    <div class="price">
                        <h1><?php echo $opt['producto'];?></h1>
                        <p>S/ <?php echo $opt['precio'];?></p>
                    </div>
                </div
                ></a>
                <?php endforeach ?>
            </div>
        </div>
        <!--PIE-->
        <?php include 'template/footer.php'; ?>
    </div>
    <script src="js/scripts.js"></script>
</body>
</html>