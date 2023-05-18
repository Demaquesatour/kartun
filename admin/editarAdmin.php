<?php
    include './php/bd.php';
    include './php/barra.php';
?>
    <div class="c-content">
        <div class="fcc c-titulo">
                <h1>Editar Administrador</h1>
            </div>
            <!--EDITAR-->
            <div class="fcc c-editar">
                <?php 
                    $id = $_GET['id'];
                    $sql = "SELECT * FROM usuario where idUsuario ='$id'";
                    $result = mysqli_query($conexion,$sql);
                    while($mostrar = mysqli_fetch_array($result)){
                ?>
                    <form class="fcsc editarForm" action="./procesoAdmin.php" method="POST">
                        <input type="hidden" value="<?php echo $mostrar['idUsuario']; ?>" name="editId">
                        <p>Nombre</p>
                        <input type="text" value="<?php echo $mostrar['nombre']; ?>" name="editNombre">
                        <p>Correo</p>
                        <input type="mail" value="<?php echo $mostrar['correo']; ?>" name="editCorreo">
                        <p>Usuario</p>
                        <input type="text" value="<?php echo $mostrar['usuario']; ?>" name="editUsuario">
                        <p>Clave</p>
                        <input type="text" value="<?php echo $mostrar['clave']; ?>" name="editClave">
                        <input class="btn-sub" type="submit" value="Actualizar">
                        <a class="back" href="./admin.php">Atrás</a>
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