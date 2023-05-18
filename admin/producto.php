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
                <h1>Panel de Productos</h1>
            </div>
            <div class="fccc c-data">
                <div class="c-agregar">
                    <form class="fcc formAgregar" action="agregarPro.php" enctype="multipart/form-data" method="POST">
                    <div class="fcsc c-input">
                            <p>Imagen</p>
                            <label id="imgSelect" for="fotoProducto">Elija una imagen</label>
                            <input id="fotoProducto" type="file" accept="image/*" name="proFoto" require>
                        </div>
                        <div class="fcsc c-input">
                            <p>Producto</p>
                            <input type="text" placeholder="Agregar producto" name="proNom" autocomplete="off" required>
                        </div>
                        <div class="fcsc c-input">
                            <p>Precio</p>
                            <input type="number" step="0000.01" min="1" max="10000" placeholder="Precio" name="proPrecio" required>
                        </div>
                        <div class="fcsc c-input">
                            <p>Cantidad</p>
                            <input type="number" step="1" min="1" max="100" placeholder="Cantidad" name="proCantidad" required>
                        </div>
                        <div class="fcsc c-input">
                            <p>Categoría</p>
                            <select name="proCategoria" class="cat-data">
                            <?php 
                                $sql = "SELECT * FROM categoria";
                                $result = mysqli_query($conexion,$sql);
                            ?>
                            <?php foreach ($result as $opt): ?>
                                <option value="<?php echo $opt['idCategoria'];?>"><?php echo $opt['categoria'];?></option>
                            <?php endforeach ?>
                            </select>
                        </div>
                        <div class="fcsc c-input">
                            <p>Detalle</p>
                            <textarea name="proDetalle" maxlength="600" required></textarea>
                        </div>
                        <div class="fcsc c-input">
                            <input class="btn-sub" type="submit" value="Agregar" name="crearPro">
                            <a class="back">Limpiar</a>
                        </div>
                    </form>
                </div>
                <table class="c-table">
                        <thead>
                            <tr>
                                <th scope="col">Imagen</th>
                                <th scope="col">Producto</th>
                                <th scope="col">Precio</th>
                                <th scope="col">Cantidad</th>
                                <th scope="col">Categoría</th>
                                <th scope="col">Detalle</th>
                                <th scope="col">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $sql = "SELECT * FROM producto ORDER BY idProducto DESC";
                                $result = mysqli_query($conexion,$sql);
                                while($mostrar = mysqli_fetch_array($result)){
                            ?>
                            <tr>
                                <td><img id="showFoto" src="<?php echo $mostrar['enlace'] ?>" alt=""></td>
                                <td><?php echo $mostrar['producto'] ?></td>
                                <td><?php echo $mostrar['precio'] ?></td>
                                <td><?php echo $mostrar['cantidad'] ?></td>
                                <td><?php echo $mostrar['catProducto'] ?></td>
                                <td id="data-text"><?php echo $mostrar['detalle'] ?></td>
                                <td class="fsc opt">
                                    <a class="fcc" href="editarPro.php?id=<?php echo $mostrar['idProducto']; ?>"><i id="editar" class='bx bxs-cog' ></i></a>
                                    <a class="fcc" href="variante.php?id=<?php echo $mostrar['idProducto']; ?>"><i id="variante" class='bx bx-spreadsheet'></i></a>
                                    <a class="fcc" href="eliminarPro.php?id=<?php echo $mostrar['idProducto']; ?>"><i id="eliminar" class='bx bxs-trash-alt'></i></a>
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