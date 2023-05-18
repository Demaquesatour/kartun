<?php
    include 'php/bd.php';
    include 'php/barra.php';
    if (!isset($_SESSION['usuario'])){
        header("Location:login.php");
        exit(0);
    }
    $id = $_GET['id'];
?>
    <!--DATA-->
    <div class="c-content">
        <div class="fcc c-titulo">
            <h1>Panel de Descuentos de Categoria</h1>
        </div>
        <div class="fccc c-data">
            <div class="c-agregar">
                <form class="fcc" action="agregarDescuento.php" method="POST">
                    <div class="fcsc c-input">
                        <p>Cantidad</p>
                        <input type="text" placeholder="Agregar Cantidad" name="canDesc" oninput="this.value = this.value.toUpperCase()">
                    </div>
                    <div class="fcsc c-input">
                        <p>Descuento en %</p>
                        <input type="text" placeholder="Agregar Descuento" name="desDesc" oninput="this.value = this.value.toUpperCase()">
                    </div>
                    <div class="fcsc c-input">
                        <input type="hidden" value="<?php echo $id; ?>" name="cateId">
                        <?php 
                            $sql = "SELECT * FROM categoria WHERE `idCategoria` = '$id'";
                            $result = mysqli_query($conexion,$sql);
                            while($mostrar = mysqli_fetch_array($result)){
                        ?>
                        <input type="hidden" value="<?php echo $mostrar['categoria'] ?>" name="catName">
                        <?php
                            } 
                        ?>
                        <input class="btn-sub" type="submit" value="Agregar">
                        <a href="/kartun/admin/categoria.php" class="back">Atrás</a>
                    </div>
                </form>
            </div>
            <table class="c-table">
                <thead>
                    <tr>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Descuento</th>
                        <th scope="col">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $sql = "SELECT * FROM descuento WHERE `categoriaId` = '$id'";
                        $result = mysqli_query($conexion,$sql);
                        while($mostrar = mysqli_fetch_array($result)){
                    ?>
                    <tr>
                        <td><?php echo $mostrar['cantidad'] ?></td>
                        <td><?php echo $mostrar['descuento'] ?></td>
                        <td class="fsc opt">
                            <a class="fcc" href="editarDesc.php?id=<?php echo $mostrar['idDescuento']; ?>"><i id="editar" class='bx bxs-cog'></i></a>
                            <a class="fcc" href="eliminarDesc.php?id=<?php echo $mostrar['idDescuento']; ?>"><i id="eliminar" class='bx bxs-trash-alt'></i></a>
                        </td>
                    </tr>
                    <?php
                    } 
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    </div>
    <script src="js/scripts.js"></script>
</body>
</html>