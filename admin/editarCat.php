<?php
    include './php/bd.php';
    include './php/barra.php';
?>
    <div class="c-content">
        <div class="fcc c-titulo">
                <h1>Editar Categoría</h1>
            </div>
            <!--EDITAR-->
            <div class="fcc c-editar">
                <?php 
                    $id = $_GET['id'];
                    $sql = "SELECT * FROM categoria where idCategoria ='$id'";
                    $result = mysqli_query($conexion,$sql);
                    while($mostrar = mysqli_fetch_array($result)){
                ?>
                    <form class="fcsc editarForm" action="./procesoCat.php" method="POST">
                        <input type="hidden" value="<?php echo $mostrar['idCategoria']; ?>" name="editId">
                        <p>Categoría</p>
                        <input type="text" value="<?php echo $mostrar['categoria']; ?>" name="editNombre">
                        <input class="btn-sub" type="submit" value="Actualizar">
                        <a class="back" href="./categoria.php">Atrás</a>
                    </form>
                <?php
                    } 
                ?>
                </div>
            </div>
    </div>
    <script src="js/scripts.js"></script>
</body>
</html>