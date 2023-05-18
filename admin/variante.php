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
            <h1>Panel de Talla del Producto</h1>
        </div>
        <div class="fccc c-data">
            <div class="c-agregar">
                <form class="fcc" action="agregarVar.php" method="POST">
                    <div class="fcsc c-input">
                        <p>Talla</p>
                        <input type="text" placeholder="Agregar Talla" name="varNom" oninput="this.value = this.value.toUpperCase()">
                        <input type="hidden" value="<?php echo $id; ?>" name="idProducto">
                    </div>
                    <div class="fcsc c-input">
                        <input class="btn-sub" type="submit" value="Agregar">
                        <a href="/kartun/admin/producto.php" class="back">Atrás</a>
                    </div>
                </form>
            </div>
            <table class="c-table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Variante</th>
                        <th scope="col">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $sql = "SELECT * FROM variante WHERE `productoId` = '$id'";
                        $result = mysqli_query($conexion,$sql);
                        while($mostrar = mysqli_fetch_array($result)){
                    ?>
                    <tr>
                        <td><?php echo $mostrar['idVariante'] ?></td>
                        <td><?php echo $mostrar['descripcion'] ?></td>
                        <td class="fsc opt">
                            <a class="fcc" href="editarVar.php?id=<?php echo $mostrar['idVariante']; ?>"><i id="editar" class='bx bxs-cog'></i></a>
                            <a class="fcc" href="eliminarVar.php?id=<?php echo $mostrar['idVariante']; ?>"><i id="eliminar" class='bx bxs-trash-alt'></i></a>
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