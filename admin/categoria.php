<?php
    include 'php/bd.php';
    include 'php/barra.php';
    if (!isset($_SESSION['usuario'])){
        header("Location:login.php");
        exit(0);
    }
?>
    <!--DATA-->
    <div class="c-content">
        <div class="fcc c-titulo">
            <h1>Panel de Categoría</h1>
        </div>
        <div class="fccc c-data">
            <div class="c-agregar">
                <form class="fcc" action="agregarCat.php" method="POST">
                    <div class="fcsc c-input">
                        <p>Categoría</p>
                        <input type="text" placeholder="Agregar Categoría" name="catNom">
                    </div>
                    <div class="fcsc c-input">
                        <input class="btn-sub" type="submit" value="Agregar">
                        <a class="back">Limpiar</a>
                    </div>
                </form>
            </div>
            <table class="c-table">
                    <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Categoría</th>
                                <th scope="col">Opciones</th>
                            </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $sql = "SELECT * FROM categoria";
                            $result = mysqli_query($conexion,$sql);
                            while($mostrar = mysqli_fetch_array($result)){
                        ?>
                        <tr>
                            <td><?php echo $mostrar['idCategoria'] ?></td>
                            <td><?php echo $mostrar['categoria'] ?></td>
                            <td class="fsc opt">
                                <a class="fcc" href="editarCat.php?id=<?php echo $mostrar['idCategoria']; ?>"><i id="editar" class='bx bxs-cog'></i></a>
                                <a class="fcc" href="descuento.php?id=<?php echo $mostrar['idCategoria']; ?>"><i id="descuento" class='bx bxs-offer'></i></a>
                                <a class="fcc" href="eliminarCat.php?id=<?php echo $mostrar['idCategoria']; ?>"><i id="eliminar" class='bx bxs-trash-alt'></i></a>
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