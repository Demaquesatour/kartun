<?php
    include './php/bd.php';
    include './php/barra.php';
?>
    <div class="c-content">
        <div class="fcc c-titulo">
                <h1>Editar Producto</h1>
            </div>
            <!--EDITAR-->
            <div class="fcc c-editar">
                <?php 
                    $id = $_GET['id'];
                    $sql = "SELECT * FROM producto where idProducto ='$id'";
                    $result = mysqli_query($conexion,$sql);
                    while($mostrar = mysqli_fetch_array($result)){
                ?>
                    <form class="fcsc editarForm" action="./procesoPro.php" enctype="multipart/form-data" method="POST">
                        <input type="hidden" value="<?php echo $mostrar['idProducto']; ?>" name="editId">
                        <p>Actualizar Imagen</p>
                        <input type="hidden" value="<?php echo $mostrar['enlace'];?>" name="rutaOld">
                        <label id="imgSelect" for="fotoProducto">Elija una imagen</label>
                        <input id="fotoProducto" type="file" accept="image/*" name="editFoto" require>
                        <p>Producto</p>
                        <input type="text" value="<?php echo $mostrar['producto']; ?>" name="editProducto">
                        <p>Precio</p>
                        <input type="number" value="<?php echo $mostrar['precio']; ?>" step="0000.01" min="1" max="10000" name="editPrecio">
                        <p>Cantidad</p>
                        <input type="number" value="<?php echo $mostrar['cantidad']; ?>" step="0000.01" min="1" max="10000" name="editCantidad">
                        <p>Categoría</p>
                        <select name="editCategoria" class="cat-data">
                        <?php 
                            $sql = "SELECT * FROM categoria";
                            $result = mysqli_query($conexion,$sql);
                        ?>
                        <?php foreach ($result as $opt): ?>
                            <option value="<?php echo $opt['idCategoria'];?>"><?php echo $opt['categoria'];?></option>
                        <?php endforeach ?>
                        </select>
                        <p>Detalle</p>
                        <textarea maxlength="600" name="editDetalle" required><?php echo $mostrar['detalle']; ?></textarea>
                        <input class="btn-sub" type="submit" name="updImg" value="Actualizar">
                        <a class="back" href="./producto.php">Atrás</a>
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