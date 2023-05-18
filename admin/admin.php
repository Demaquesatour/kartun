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
                <h1>Panel de Administrador</h1>
            </div>
            <div class="fccc c-data">
                <div class="c-agregar">
                    <form class="fcc" action="agregarAdmin.php" method="POST">
                        <div class="fcsc c-input">
                            <p>Nombre</p>
                            <input type="text" placeholder="Agregar usuario" name="admNom">
                        </div>
                        <div class="fcsc c-input">
                            <p>Correo</p>
                            <input type="mail" placeholder="Agregar Correo" name="admCo">
                        </div>
                        <div class="fcsc c-input">
                            <p>Usuario</p>
                            <input type="text" placeholder="Agregar Usuario" name="admUsu">
                        </div>
                        <div class="fcsc c-input">
                            <p>Clave</p>
                            <input type="password" placeholder="Agregar Clave" name="admCla">
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
                                <th scope="col">Nombre</th>
                                <th scope="col">Correo</th>
                                <th scope="col">Usuario</th>
                                <th scope="col">Clave</th>
                                <th scope="col">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $sql = "SELECT * FROM usuario";
                                $result = mysqli_query($conexion,$sql);
                                while($mostrar = mysqli_fetch_array($result)){
                            ?>
                            <tr>
                                <td><?php echo $mostrar['idUsuario'] ?></td>
                                <td><?php echo $mostrar['nombre'] ?></td>
                                <td><?php echo $mostrar['correo'] ?></td>
                                <td><?php echo $mostrar['usuario'] ?></td>
                                <td><?php echo $mostrar['clave'] ?></td>
                                <td class="fsc opt">
                                        <a class="fcc" href="editarAdmin.php?id=<?php echo $mostrar['idUsuario']; ?>"><i id="editar" class="fa-solid fa-gear"></i></a>
                                        <a class="fcc" href="eliminarAdmin.php?id=<?php echo $mostrar['idUsuario']; ?>"><i id="eliminar" class="fa-solid fa-trash"></i></a>
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