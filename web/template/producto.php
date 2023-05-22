<?php 
    include '../php/bd.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!---BOX ICONS--->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!---SWEET ALERT--->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.all.min.js"></script>
    <title>KARTUN</title>
</head>
<body>
    <div class="base">
        <!--WSP-->
        <?php include './wsp.php'; ?>
        <!--MENU-->
        <?php include './menu.php'; ?>
        <div class="mdl-size">
                <div class="cdr-sz">
                    <div class="sz-t">
                        <h3>CUADRO DE MEDIDAS</h3>
                        <i class='bx bx-x close'></i>
                    </div>
                    <div class="sz-inf">
                        <div class="inf-data">
                            <p>XS = 24- 26</p>
                        </div>
                        <div class="inf-data">
                            <p>S = 26 - 28</p>
                        </div>
                        <div class="inf-data">
                            <p>M = 28 - 30</p>
                        </div>
                        <div class="inf-data">
                            <p>L = 30 - 32</p>
                        </div>
                        <div class="inf-data">
                            <p>XL = 32 - 34</p>
                        </div>
                        <div class="inf-data">
                            <p>XXL = 34 - 36</p>
                        </div>
                        <div class="inf-data cuadro">
                            <p>AL LADO DE LAS TALLAS PODRÁS ENCONTRAR EL CUADRO DE MEDIDAS CON ESTE SIMBOLO</p>
                        </div>
                        <div class="inf-data iconsz">
                            <div class="sizing">
                                <i class='bx bxs-t-shirt'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php 
            $id = $_GET['id'];
            $sql = "SELECT * FROM producto where idProducto = '$id'";
            $result = mysqli_query($conexion,$sql);
            // var_dump($id);
        ?>
        <?php foreach ($result as $opt): ?>
            <div class="product">
                <div class="picture">
                    <div class="opt">
                        <img src="/kartun/admin/<?php echo $opt['enlace'];?>" alt="">
                    </div>
                </div>
                <div class="desc">
                    <div class="desc-art">
                        <div class="art">
                            <h1><?php echo $opt['producto'];?></h1> 
                            <h2><?php echo $opt['catProducto'];?></h2>
                        </div>
                        <div class="mount">
                            <p>DESDE</p>
                            <div class="mn-off">
                                <h3 id="total">S/ <?php echo $opt['precio'];?></h3>
                                <span id="discount">S/ </span>
                            </div>
                            <!-- <h3><del>S/ <?php echo $opt['precio'];?></del></h3> -->
                        </div>
                            <?php 
                                $sql = "SELECT * FROM variante where productoId  = '$id'";
                                $result = mysqli_query($conexion,$sql);
                                if (mysqli_num_rows($result) > 0) {
                            ?>
                                <div class="size">
                                    <p>TALLAS</p>
                                    <div class="szs">
                                    <?php foreach ($result as $rt): ?>
                                        <label><input id="talla" value="<?php echo $rt['descripcion'];?>" class="tallas" type="radio" name="prdTalla"><?php echo $rt['descripcion'];?></label>
                                    <?php endforeach ?>
                                        <div class="sizing cdrTallas">
                                            <i class='bx bxs-t-shirt'></i>
                                        </div>
                                    </div>
                                </div>
                                <script>
                                    //Seleccionar todos los labels con la clase "talla"
                                    const tallas = document.querySelectorAll('.tallas');
                                    tallas.forEach((talla) => {
                                        talla.addEventListener('click', (event) => {
                                            // Remover atributo checked de todos los inputs de tallas
                                            tallas.forEach((t) => {
                                            t.checked = false;
                                            t.parentNode.style.color = 'white'; // Color original del label
                                            });
                                            // Agregar atributo checked y cambiar color del label correspondiente
                                            event.target.checked = true;
                                            event.target.parentNode.style.color = '#FC81EF'; // Nuevo color del label
                                        });
                                    });

                                    //Mostrar el cuadro de medidas
                                    const cls = document.querySelector('.close');
                                    const mdlr = document.querySelector('.mdl-size');
                                    const cdr = document.querySelector('.cdrTallas');
                                    cls.addEventListener('click', () =>{
                                        mdlr.classList.remove('out');
                                        setTimeout(() => {
                                            mdlr.style.display = 'none';
                                        }, 500);
                                    });

                                    cdr.addEventListener('click', () =>{
                                        mdlr.style.display = 'flex';
                                        setTimeout(() => {
                                            mdlr.classList.add('out');
                                        }, 500);
                                    });

                                </script>
                            <?php
                                }else{
                            ?>
                                <input id="talla" type="hidden" name="prdTalla">    
                            <?php
                                }
                            ?>
                            <div class="cant">
                                <p>CANTIDAD</p>
                                <div class="quanty">
                                    <i class='bx bx-minus'></i>
                                    <input id="cantidad" type="number" min="1" max="30" value="1" name="prdCant"></input>
                                    <i class='bx bx-plus'></i>
                                </div>
                            </div>
                            <div class="texto">
                                <div class="subtitulo">
                                    <h2>Detalles</h2>
                                </div>
                                <div class="expand plus-data">
                                    <p><?php echo $opt['detalle'];?></p>
                                </div>
                            </div>
                            <input type="hidden" id="idProducto" value="<?php echo $opt['idProducto'];?>" name="prdId">
                            <input type="hidden" id="precio" value="<?php echo $opt['precio'];?>" name="prdPre">
                            <input type="hidden" id="categoria" value="<?php echo $opt['categoriaId'];?>" name="prdCat">
                            <input type="hidden" id="descontando" value="" name="dscnt">
                            <div class="btn">
                                <button id="btnAgregar" class="comprar">AGREGAR AL CARRITO</button>
                            </div>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
        <script>
            const cantidadInput = document.getElementById('cantidad');
            const plusBtn = document.querySelector('.bx-plus');
            const minusBtn = document.querySelector('.bx-minus');
            const precioTotal = document.getElementById('total');
            const descuento = document.getElementById('discount');
            const descontando = document.getElementById('descontando');
            const precio = <?php echo $opt['precio']; ?>; // Obtener el precio base desde PHP

            // Agregar eventos de clic
            plusBtn.addEventListener('click', () => {
                let cantidad = parseInt(cantidadInput.value);
                cantidad = isNaN(cantidad) ? 1 : cantidad;
                cantidad = Math.min(cantidad + 1, 12); // Actualizar la cantidad aquí
                cantidadInput.value = cantidad;
                actualizarPrecioTotal(cantidad);
            });

            minusBtn.addEventListener('click', () => {
                let cantidad = parseInt(cantidadInput.value);
                cantidad = isNaN(cantidad) ? 1 : cantidad;
                cantidad = Math.max(cantidad - 1, 1); // Actualizar la cantidad aquí
                cantidadInput.value = cantidad;
                actualizarPrecioTotal(cantidad);
            });

            function actualizarPrecioTotal(cantidad) {
                // Calcular el precio total y el descuento
                const precioConDescuento = calcularPrecioConDescuento(precio, cantidad);
                // Actualizar los elementos HTML
                if (cantidad === 1) { // Usar === para comparar valores
                    precioTotal.innerHTML = `S/ ${precio}`;
                    descuento.style.display = 'none';
                    descontando.value = `0.00`;
                } else if (cantidad >= 2 && cantidad <= 12) { // Usar === para comparar valores
                    precioTotal.innerHTML = `S/ <del>${precio}</del>`;
                    descuento.style.display = 'block';
                    descuento.innerHTML = `S/ ${precioConDescuento}`;
                    descontando.value = `${precioConDescuento}`;
                }
            }

            function calcularPrecioConDescuento(precioBase, cantidad) {
                // Calcula el precio con descuento según la cantidad seleccionada
                let precioConDescuento = precioBase;
                if (cantidad === 1) {
                    precioConDescuento = precioBase; // Descuento del 5% para 5-9 unidades 
                <?php
                    $cate = $_GET['cat'];
                    $sql = "SELECT * FROM descuento  where categoria  = '$cate'";
                    $result = mysqli_query($conexion,$sql);
                ?>
                <?php foreach ($result as $dt): ?>
                } else if (cantidad === <?php echo $dt['cantidad']; ?>) {
                    precioConDescuento = precioBase - (precioBase * (<?php echo $dt['descuento']; ?> / 100)); // Descuento del 10% para 10-14 unidades
                <?php endforeach ?>
                } else {
                    <?php
                        $sql = "SELECT * FROM descuento where categoriaId  = '1' ORDER BY cantidad DESC LIMIT 1";
                        $result = mysqli_query($conexion,$sql);
                        $dt = mysqli_fetch_assoc($result);
                    ?>
                    precioConDescuento = precioBase - (precioBase * (<?php echo $dt['descuento']; ?> / 100)); // Descuento del último porcentaje para 15 o más unidades
                }
                return precioConDescuento.toFixed(2); // Redondear a 2 decimales
            }

            function actualizarPrecio(){
                fetch('../php/updPrice.php')
                .then(response => response.text())
                .then(subtotal => {
                    const contenedorSubtotal = document.querySelector('.sb-ttl p');
                    contenedorSubtotal.textContent = `S/${subtotal}`;
                });
            }

            function actualizarCarrito(){
                fetch('../php/updCart.php')
                    .then(response => response.text())
                    .then(numeroProductos => {
                    const contador = document.querySelector('.cnt p');
                    const boxContador = document.querySelector('.cnt');
                    contador.innerText = numeroProductos;
                    boxContador.classList.add('zoomIn');
                    setTimeout(() => {
                        boxContador.classList.remove('zoomIn');
                    }, 300);
                    console.log('Carrito Actualizado');
                    })
                    .catch(error => {
                    console.error('Ocurrió un error al actualizar el número de productos en el carrito:', error);
                    });
            }

            function actualizarProductos(){
                const contenedorProductos = document.querySelector('#productos-carrito');
                fetch('../php/getCart.php')
                .then(response => response.text())
                .then(html => {
                    contenedorProductos.innerHTML = html;
                    const botonesEliminar = document.querySelectorAll('.eliProducto');
                    botonesEliminar.forEach(boton => {
                        boton.addEventListener('click', eliminarProducto);
                    });
                });
            }

            //LimpiarTallas
            function LimpiarTallas(){
                //Verificar si existen tallas
                const contenedorTallas = document.querySelector('.szs');
                if (contenedorTallas) {
                    const tlls = contenedorTallas.querySelectorAll('.tallas');
                    tlls.forEach((tll) =>{
                        tll.checked = false;
                        tll.parentNode.style.color = 'white';
                    });
                }
            }

            //Agregar Producto
            const btnAgregar = document.querySelector('#btnAgregar');
            btnAgregar.addEventListener('click', agregarProducto);
            btnAgregar.addEventListener('click', LimpiarTallas);
            btnAgregar.addEventListener('click',() =>{
                cantidadInput.value = 1;
                descuento.style.display = 'none';
                precioTotal.innerHTML = `S/ ${precio}`;
            });

            function agregarProducto() {
                const idProducto = document.getElementById('idProducto').value;
                const idCategoria = document.getElementById('categoria').value;
                const cantidad = document.getElementById('cantidad').value;
                const precio = document.getElementById('precio').value;
                let descPrecio = document.getElementById('descontando').value;
                let talla;
                const opcionesTalla = document.getElementsByClassName('tallas');
                const opcionesArray = Array.from(opcionesTalla);

                opcionesArray.forEach(opt => {
                    if (opt.checked) {
                        talla = opt.value;
                    }
                });
                
                if (typeof descPrecio === 'undefined' || descPrecio === '') {
                    descPrecio = precio;
                }

                // console.log(idProducto);
                // console.log(idCategoria);
                // console.log(talla);
                // console.log(cantidad);
                // console.log(precio);
                // console.log(descPrecio);

                fetch('../php/addCart.php', {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded"
                    },
                    body:`prdId=${idProducto}&prdTalla=${talla}&prdCant=${cantidad}&prdPre=${precio}&dscnt=${descPrecio}&prdCat=${idCategoria}`
                })
                .then(response =>{
                    if (response.ok) {
                        return response.text();
                    } else {
                        throw new Error("Error al agregar el producto.");
                    }
                })
                .then(data => {
                    if (data.startsWith("Error:")) {
                        Swal.fire({
                        icon: 'error',
                        title: '¡ERROR!',
                        text: 'Solo se pueden agregar 12 unidades por producto.'
                        });
                    } else {
                        console.log(data);
                        actualizarCarrito();
                        actualizarProductos();
                        actualizarPrecio();
                    }
                })
                .catch(error =>{
                    console.error(error);
                });
            }
        </script>
        <div class="prd-rlt">
            <div class="tit-rlt">
                <h2>PRODUCTOS RELACIONADOS</h2>
            </div>
            <div class="rlt">
            <?php 
                $cate = $_GET['cat'];
                $sql = "SELECT * FROM producto WHERE `catProducto` = '$cate' ORDER BY RAND() LIMIT 4";
                $result = mysqli_query($conexion,$sql);
            ?>
            <?php foreach ($result as $art): ?>
                <a href="/kartun/web/template/producto.php?id=<?php echo $art['idProducto'];?>&cat=<?php echo $art['catProducto'];?>">
                    <div class="rlt-art">
                        <img src="/kartun/admin/<?php echo $art['enlace'];?>" alt="">
                        <div class="art-sz">
                        <?php 
                            $id = $art['idProducto'];
                            $sql = "SELECT * FROM variante where productoId  = '$id'";
                            $result = mysqli_query($conexion,$sql);
                        ?>
                            <?php foreach ($result as $sz): ?>
                            <p><?php echo $sz['descripcion'];?></p>
                            <?php endforeach ?>
                        </div>
                        <div class="art-data">
                            <h3><?php echo $art['producto'];?></h3>
                            <p>S/ <?php echo $art['precio'];?></p>
                        </div>
                    </div>
                </a>
            <?php endforeach ?>
            </div>
        </div>
        <?php include './footer.php'; ?>
    </div>
</body>
</html>