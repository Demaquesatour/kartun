<?php 
session_start();
$id = $_SESSION['idCliente'];
?>
<div class="menu">
    <div class="logo">
        <a href="#ini"><img id="logotipo" src="/kartun/web/img/logo.png"></a>
    </div>
    <div class="enlace">
        <a href="#pants">Pants</a>
        <a href="#sh">Shorts</a>
        <a href="#mo">Mochilitas</a>
        <a href="#po">Polos</a>
        <a href="#plr">Poleras</a>
        <a href="#cont">Contacto</a>
    </div>
    <div class="user">
        <div class="c-sr usuario">
            <?php
            if(isset($_SESSION['usuario'])){
                ?>
                    <i style="color:#FC81EF" class='bx bxs-user isUsr'></i>
                    <h4 style="color:#FC81EF"><?php echo $_SESSION['usuario']; ?></h4>
                    <div class="lgOut">
                        <a class="sesionOut" href="/kartun/web/php/logOut.php">CERRAR SESIÓN</a>
                    </div>
                    <script>
                            //Slide Down
                            const lgOut = document.querySelector('.lgOut');
                            const userExist = document.querySelector('.isUsr');

                            userExist.addEventListener('click', () =>{
                                setTimeout(() => {
                                    lgOut.classList.toggle('slideDown');
                                }, 300);
                            })
                    </script>
                <?php
            }else{
                ?> 
                    <i class='bx bxs-user data-usr'></i>
                    <script>
                        const user = document.querySelector('.data-usr');
                        user.addEventListener('click', () =>{
                        modal.style.display = 'flex';
                        frmUsr.style.display = 'flex';
                        setTimeout(() => {
                            modal.classList.remove('hide');
                            frmUsr.classList.remove('hide');
                            }, 350);
                        });
                    </script>
                <?php
            }
            ?>
        </div>
        <div class="c-sr">
            <i class='bx bxs-cart'></i>
            <div class="cnt">
            <?php 
                $consulta = "SELECT COUNT(*) as Cantidad FROM carrito c INNER JOIN detalle_carrito d ON c.idCarrito = d.carritoId WHERE clienteId = '$id' AND c.autorizado = true";
                $resultado = mysqli_query($conexion, $consulta);
                while($mostrar = mysqli_fetch_array($resultado)){
            ?>
                <p><?php echo $mostrar['Cantidad']; ?></p>
            <?php 
                }
            ?>
            </div>
        </div>
    </div>
    <div class="barra-btn">
        <i id="c-ventana" class="fa-solid fa-xmark"></i>
        <i id="ventana" class="fa-solid fa-bars"></i>
    </div>
</div>
<!--MODAL-->
<div class="mdl">
    <!--INICIO DE SESION-->
    <div class="lg-in">
        <form action="/kartun/web/php/auth.php" method="POST">
            <div class="frm-ttl">
                <h2>INICIO DE SESIÓN</h2>
                <i class='bx bx-x'></i>
            </div>
            <div class="frm-npt">
                <p>USUARIO</p>
                <input class="bs-npt" type="text" name="usuario" required autocomplete="off">
            </div>
            <div class="frm-npt">
                <p>CONTRASEÑA</p>
                <div class="lck">
                    <input class="wrd" type="password" name="clave" required>
                    <div class="i-lkd">
                        <i class='locked bx bxs-lock'></i>
                    </div>
                </div>
            </div>
            <div class="frm-npt nvr">
                <input id="spc-btn" value="INGRESAR" type="submit">
            </div>
        </form>
        <div class="lg-ft">
            <div class="c-ft frgt">
                <i class='bx bx-help-circle'></i>
                <p>OLVIDÉ MI CONTRASEÑA</p>
            </div>
            <div class="c-ft sgnUp">
                <i class='bx bx-user-plus'></i>
                <p>CREAR CUENTA NUEVA</p>
            </div>
        </div>
    </div>
    <!--NUEVO REGISTRO-->
    <div class="sgn-up">
        <form action="/kartun/web/php/addRgt.php" method="POST">
            <div class="frm-ttl">
                <h2>CREAR UNA CUENTA</h2>
                <i class='bx bx-x'></i>
            </div>
            <div class="frm-npt">
                <p>USUARIO</p>
                <input class="bs-npt" type="text" name="agrusu" required autocomplete="off">
            </div>
            <div class="frm-npt">
                <p>NOMBRE</p>
                <input class="bs-npt" type="text" name="agrnom" required>
            </div>
            <div class="frm-npt">
                <p>CORREO</p>
                <input class="bs-npt" type="text" name="agrmail" required>
            </div>
            <div class="frm-npt">
                <p>CONTRASEÑA</p>
                <div class="lck">
                    <input id="psw1" class="wrd" type="password" name="agrclave" required>
                    <div class="i-lkd">
                        <i class='locked bx bxs-lock'></i>
                    </div>
                </div>
            </div>
            <div class="frm-npt">
                <p>VERIFICAR CONTRASEÑA</p>
                <div class="lck">
                    <input id="psw2" class="wrd" type="password" name="agrclave2" required>
                    <div class="i-lkd">
                        <i class='locked bx bxs-lock'></i>
                    </div>
                </div>
            </div>
            <div class="frm-npt nvr">
                <input id="spc-btn" value="CREAR" type="submit">
            </div>
        </form>
        <div class="lg-ft">
            <div class="c-ft frgt2">
                <i class='bx bx-help-circle'></i>
                <p>OLVIDÉ MI CONTRASEÑA</p>
            </div>
            <div class="c-ft lgIn">
                <i class='bx bx-user-circle'></i>
                <p>INICIAR SESIÓN</p>
            </div>
        </div>
    </div>
    <!--RECUPERAR  CONTRASEÑA-->
    <div class="rcvr">
        <form action="">
            <div class="frm-ttl">
                <h2>RECUPERAR CONTRASEÑA</h2>
                <i class='bx bx-x'></i>
            </div>
            <div class="frm-npt">
                <p>CORREO</p>
                <input class="bs-npt" type="email" required autocomplete="off">
            </div>
            <div class="frm-npt nvr">
                <input id="spc-btn" value="RECUPERAR" type="submit">
            </div>
        </form>
        <div class="lg-ft">
            <div class="c-ft lgIn2">
                <i class='bx bx-user-circle'></i>
                <p>INICIAR SESIÓN</p>
            </div>
            <div class="c-ft sgnUp2">
                <i class='bx bx-user-plus'></i>
                <p>CREAR CUENTA NUEVA</p>
            </div>
        </div>
    </div>
</div>
<!--CARRITO-->
<div class="mdl-cart">
    <div class="pagado">
        <h2>¡PAGO REALIZADO!</h2>
        <p>Su pedido esta siendo procesado, durante las próximas 48 horas nos comunicaremos con usted a la brevedad de lo posible. Muchas gracias por comprar con nosotros</p>
        <i class='bx bxs-truck'></i>
        <button class="continuar">SEGUIR VIENDO</button>
    </div>
    <!--FORMULARIO DE CLIENTE-->
    <div class="frmCliente frmCart">
        <div class="form">
            <div class="frmTtl">
                <h2>DATOS DEL CLIENTE</h2>
            </div>
            <div class="frmData">
                <div class="dt-npt">
                    <h4>TIPO DE DOCUMENTO</h4>
                    <select name="slcDoc" id="tipo" required>
                        <option disabled selected>DOCUMENTO</option>
                        <option value="DNI">DNI</option>
                        <option value="CADEX">CARNET DE EXTRANJERÍA</option>
                    </select>
                </div>
                <div class="dt-npt">
                    <h4>NÚMERO DE DOCUMENTO</h4>
                    <input type="text" id="documento" name="numDoc" oninput="cambiarColor(this)" required>
                </div>
                <div class="dt-npt">
                    <h4>NOMBRE COMPLETO</h4>
                    <input type="text" id="nombreCompleto" name="nomCon" required>
                </div>
                <div class="dt-npt">
                    <h4>CELULAR</h4>
                    <input type="text" name="celCon" id="telefono" oninput="cambiarColor(this)" required>
                </div>
                <div class="dt-npt endShop">
                    <button class="envContacto">SIGUIENTE</button>
                    <?php 
                        $sql = "SELECT * FROM carrito WHERE clienteId = '$id' AND autorizado = true";
                        $result = mysqli_query($conexion, $sql);
                    ?>
                    <?php foreach ($result as $rs): ?>
                    <input type="hidden" name="cartShop" id="carrito" value="<?php echo $rs['idCarrito'];?>">
                    <?php endforeach ?>
                </div>
            </div>
        </div>
    </div>
    <!--FORMULARIO DE DESTINO-->
    <div class="frmDestino frmCart">
        <div class="form">
            <div class="frmTtl">
                <h2>DATOS DEL ENVÍO</h2>
            </div>
            <div class="frmData">
                <div class="dt-npt">
                    <h4>TIPO DE ENTREGA</h4>
                    <select name="slcEnt" id="entrega" required>
                        <option disabled selected>SELECCIONE</option>
                        <option value="RECOJO">RECOJO</option>
                        <option value="ENVÍO">ENVÍO</option>
                    </select>
                </div>
                <div class="dt-npt hd">
                    <h4>DEPARTAMENTO</h4>
                    <select name="slcDep" id="dprt" required>
                        <option disabled selected>SELECCIONE</option>
                        <?php 
                            $sql = "SELECT * FROM departamentos";
                            $result = mysqli_query($conexion,$sql);
                        ?>
                        <?php foreach ($result as $des): ?>
                        <option value="<?php echo $des['idDepartamento'];?>" data-price="<?php echo $des['precio'];?>" data-status="<?php echo $des['status'];?>"><?php echo $des['departamento'];?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="dt-npt hd">
                    <h4>PROVINCIA</h4>
                    <select name="slcPro" id="prvnc" required>
                        <option disabled selected>- - - - - - -</option>
                    </select>
                </div>
                <div class="dt-npt hd">
                    <h4>DISTRITO</h4>
                    <select name="slcDis" id="dstr" required>
                        <option disabled selected>- - - - - - -</option>
                    </select>
                </div>
                <div class="dt-npt hd">
                    <h4>DIRECCIÓN EXACTA</h4>
                    <input id="direccion" name="dir" type="text" required>
                </div>
                <div class="dt-npt hd">
                    <h4>REFERENCIA</h4>
                    <input id="referencia" name="ref" type="text" required>
                </div>
                <div class="dt-npt hiden">
                    <h4>DIRECCIÓN</h4>
                    <p>Jr. Risso 374 - Stand 12, Lince </p>
                </div>
                <div class="dt-npt hiden">
                    <h4>HORARIO DE RECOJO</h4>
                    <p>02:00 pm - 05:00 pm</p>
                </div>
                <div style="width:80%; height:40vh;" class="dt-npt hiden">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3901.3884305799756!2d-77.03515582381591!3d-12.085539142626187!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9105c88aa7919d87%3A0x4002813832b67a14!2sJr.%20Risso%20374%2C%20Lince%2015046!5e0!3m2!1sen!2spe!4v1682452972267!5m2!1sen!2spe" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe> 
                </div>
                <div class="dt-npt endShop">
                <?php 
                    $sql = "SELECT * FROM carrito WHERE clienteId = '$id' AND autorizado = true";
                    $result = mysqli_query($conexion, $sql);
                ?>
                <?php foreach ($result as $rs): ?>
                    <input type="hidden" name="cartShop" id="carrito" value="<?php echo $rs['idCarrito'];?>">
                <?php endforeach ?>
                <button class="nextPago">SIGUIENTE</button>
                </div>
            </div>
        </div>
    </div>
        <!--FORMULARIO DE PAGO-->
    <div class="frmPago frmCart">
        <div class="form">
            <div class="frmTtl">
                <h2>DATOS DEL PAGO</h2>
            </div>
            <div class="frmData">
                <div class="dt-npt">
                    <h4>MÉTODO DE PAGO</h4>
                    <select name="slcPago" id="pago" required>
                        <option disabled selected>SELECCIONE</option>
                        <option value="aplicativo">APLICATIVO</option>
                        <option value="transferencia">TRANSFERENCIA</option>
                    </select>
                </div>
                <div class="dt-npt">
                    <h4>NÚMERO DE OPERACIÓN</h4>
                    <input type="text" id="numOpe" name="nOpe" title="Solo se aceptan números en este casillero." oninput="cambiarColor(this)" required>
                </div>
                <div class="dt-npt">
                    <h4>TITULAR DEL PAGO</h4>
                    <input id="tituPago" name="titPago" type="text" required>
                </div>
                <div class="dt-npt app">
                    <img src="/kartun/web/img/plin.jpg" alt="">
                    <img src="/kartun/web/img/yape.jpg" alt="">
                </div>
                <div class="dt-npt trs">
                    <div class="trs-cont">
                        <h5>N° de Cuenta BCP</h5>
                        <p>19193799883053</p>
                        <h5>Titular</h5>
                        <p>Nohely Bustillos</p>
                    </div>
                    <div class="trs-cont">
                        <h5>N° de Cuenta Interbank</h5>
                        <p>8983183477627</p>
                        <h5>Titular</h5>
                        <p>Nohely Bustillos</p>
                    </div>
                </div>
                <div class="dt-npt endShop">
                <?php 
                    $sql = "SELECT * FROM carrito WHERE clienteId = '$id' AND autorizado = true";
                    $cnslt = "SELECT SUM(subprecio) as 'total', SUM(descuento) as 'desctotal' FROM detalle_carrito d INNER JOIN carrito c ON d.carritoId = c.idCarrito WHERE c.clienteId = '$id' AND c.autorizado = true";
                    $cnslt2 = "SELECT delivery FROM envio e INNER JOIN carrito c ON e.carritoId = c.idCarrito WHERE c.clienteId = '$id' AND c.autorizado = true";
                    $result = mysqli_query($conexion, $sql);
                    $rst2 = mysqli_query($conexion, $cnslt);
                    $rst3 = mysqli_query($conexion, $cnslt2);
                ?>
                <?php foreach ($result as $rs): ?>
                    <input type="hidden" name="cartShop" id="carrito" value="<?php echo $rs['idCarrito'];?>">
                <?php endforeach ?>
                <?php foreach ($rst2 as $rs2): ?>
                    <input type="hidden" name="ttlpg" id="ttlPagar" value="<?php echo $rs2['total'];?>">
                    <input type="hidden" name="dscttl" id="dscTotal" value="<?php echo $rs2['desctotal'];?>">
                <?php endforeach ?>
                <?php foreach ($rst3 as $rs3): ?>
                    <input type="hidden" name="dlvry" id="delvr" value="<?php echo $rs3['delivery'];?>">
                <?php endforeach ?>
                    <button class="nextBoleta">FINALIZAR</button>
                </div>
            </div>
        </div>
    </div>
    <!--RESUEMN DE COMPRA-->
    <div class="crt-ttl">
        <div class="c-ttl">
            <h2>MI CARRITO</h2>
            <i class='bx bx-exit'></i>
        </div>
        <div class="s-crt">
            <?php
                $sql = "SELECT * FROM detalle_carrito d INNER JOIN carrito c ON d.carritoId = c.idCarrito INNER JOIN producto p ON d.productoId = p.idProducto WHERE c.clienteId = '$id' AND c.autorizado = true";
                $result = mysqli_query($conexion, $sql);
            ?>
            <?php foreach ($result as $rs): ?>
            <div class="crt-prd">
                <div class="prd-inf">
                    <div class="prd-img">
                            <img src="/kartun/admin/<?php echo $rs['enlace'];?>" alt="">
                    </div>
                    <div class="prd-dt">
                        <h3><?php echo $rs['producto'];?></h3>
                        <?php
                            $proID = $rs['idProducto'];
                            $sql = "SELECT * FROM variante where productoId  = '$proID'";
                            $result = mysqli_query($conexion,$sql);
                            if (mysqli_num_rows($result) > 0) {
                        ?>
                            <div class="prd-txt">
                            <h4>TALLA:</h4>
                            <p><?php echo $rs['variante'];?></p>
                            </div>
                            <div class="prd-txt">
                                <h4>CANTIDAD:</h4>
                                <p><?php echo $rs['cant'];?></p>
                            </div>
                            <div class="prd-txt">
                                <h4>PRECIO:</h4>
                                <p>S/ <?php echo $rs['subprecio'];?></p>
                            </div>
                        <?php 
                        } else { 
                        ?>
                            <div class="prd-txt">
                                <h4>CANTIDAD:</h4>
                                <p><?php echo $rs['cant'];?></p>
                            </div>
                            <div class="prd-txt">
                                <h4>PRECIO:</h4>
                                <p>S/ <?php echo $rs['subprecio'];?></p>
                            </div>
                        <?php } ?>       
                    </div>
                </div>
            </div>
            <?php endforeach ?>
        </div>
        <div class="s-sub">
            <?php  
                $sql2 ="SELECT SUM(subprecio) as 'total' FROM detalle_carrito d INNER JOIN carrito c ON d.carritoId = c.idCarrito WHERE c.clienteId = '$id' AND c.autorizado = true";
                $total = mysqli_query($conexion, $sql2);
                while($data = mysqli_fetch_array($total)){ 
            ?>
            <div class="sb-txs">
                <div class="tx-ttl">
                    <h3>SUBTOTAL:</h3>
                    <p id="subTotalPago">S/ <?php echo $data['total']; ?></p>
                </div>
            <?php 
                }
            ?>
            <?php  
                $sql3 ="SELECT SUM(descuento) as 'desctotal' FROM detalle_carrito d INNER JOIN carrito c ON d.carritoId = c.idCarrito WHERE c.clienteId = '$id' AND c.autorizado = true";
                $desctotal = mysqli_query($conexion, $sql3);
                while($dt = mysqli_fetch_array($desctotal)){ 
            ?>
                <div class="tx-ttl dsc">
                    <h3>DESCUENTO:</h3>
                    <p id="descTotal">S/ <?php echo $dt['desctotal']; ?></p>
                </div>
            <?php 
                }
            ?>
                <div class="tx-ttl">
                    <h3>DELIVERY:</h3>
                    <p id="deliver">-</p>
                </div>
                <div class="tx-ttl finalPrice">
                    <h3>TOTAL:</h3>
                    <p id="totalPagar">-</p>
                </div>
            </div>
        </div>
    </div>
    <!--PRODUCTOS DE COMPRA-->
    <div class="cart">
        <div class="c-ttl">
            <h2>MI CARRITO</h2>
            <i class='bx bx-exit'></i>
        </div>
        <div class="c-crt" id="productos-carrito">
            <?php
                $sql = "SELECT * FROM detalle_carrito d INNER JOIN carrito c ON d.carritoId = c.idCarrito INNER JOIN producto p ON d.productoId = p.idProducto WHERE c.clienteId = '$id' AND c.autorizado = true";
                $result = mysqli_query($conexion, $sql);
            ?>
            <?php foreach ($result as $rs): ?>
            <div class="crt-prd">
                <div class="prd-inf">
                    <div class="prd-img">
                        <img src="/kartun/admin/<?php echo $rs['enlace'];?>" alt="">
                    </div>
                    <div class="prd-dt">
                        <h3><?php echo $rs['producto'];?></h3>
                    <?php
                        $proID = $rs['idProducto'];
                        $sql = "SELECT * FROM variante where productoId  = '$proID'";
                        $result = mysqli_query($conexion,$sql);
                        if (mysqli_num_rows($result) > 0) {
                    ?>
                        <div class="prd-txt">
                        <h4>TALLA:</h4>
                        <p><?php echo $rs['variante'];?></p>
                        </div>
                        <div class="prd-txt">
                            <h4>CANTIDAD:</h4>
                            <p><?php echo $rs['cant'];?></p>
                        </div>
                        <div class="prd-txt">
                            <h4>PRECIO:</h4>
                            <p>S/ <?php echo $rs['subprecio'];?></p>
                        </div>
                    <?php }else{ ?>
                        <div class="prd-txt">
                            <h4>CANTIDAD:</h4>
                            <p><?php echo $rs['cant'];?></p>
                        </div>
                        <div class="prd-txt">
                            <h4>PRECIO:</h4>
                            <p>S/ <?php echo $rs['subprecio'];?></p>
                        </div>
                    <?php } ?>                        
                    </div>
                </div>
                <div class="prd-xt">
                    <i class='bx bx-x eliProducto' data-id="<?php echo $rs['idDetalleCarrito']; ?>"></i>
                </div>
            </div>
            <?php endforeach ?>
        </div>
        <?php  
             $sql2 ="SELECT SUM(subprecio) as 'total' FROM detalle_carrito d INNER JOIN carrito c ON d.carritoId = c.idCarrito WHERE c.clienteId = '$id' AND c.autorizado = true";
             $total = mysqli_query($conexion, $sql2);
            while($data = mysqli_fetch_array($total)){ 
        ?>
        <div class="c-sub">
            <div class="sb-ttl">
                <h3>SUBTOTAL:</h3>
                <p>S/<?php echo $data['total']; ?></p>
            </div>
            <button class="btnShop">COMPRAR</button>
        </div>
        <?php 
            }
        ?>
        <script>
            function actualizarPrecio(){
                fetch('./php/updPrice.php')
                .then(response => response.text())
                .then(subtotal => {
                    const contenedorSubtotal = document.querySelector('.sb-ttl p');
                    contenedorSubtotal.textContent = `S/${subtotal}`;
                });
            }
            function actualizarCarrito() {
                fetch('./php/updCart.php')
                    .then(response => response.text())
                    .then(numeroProductos => {
                    const contador = document.querySelector('.cnt p');
                    contador.innerText = numeroProductos;
                    console.log('Carrito Actualizado');
                    })
                    .catch(error => {
                    console.error('Ocurrió un error al actualizar el número de productos en el carrito:', error);
                    });
            }
            function actualizarProductos(){
                const contenedorProductos = document.querySelector('#productos-carrito');
                fetch('./php/getCart.php')
                .then(response => response.text())
                .then(html => {
                    contenedorProductos.innerHTML = html;
                    const botonesEliminar = document.querySelectorAll('.eliProducto');
                    botonesEliminar.forEach(boton => {
                        boton.addEventListener('click', eliminarProducto);
                    });
                });
            }
            const botonesEliminar = document.querySelectorAll('.eliProducto');
            botonesEliminar.forEach(boton => {
            boton.addEventListener('click', eliminarProducto);
            });
            function eliminarProducto(event) {
                const idProducto = event.target.dataset.id;
                fetch(`/kartun/web/php/dltCart.php?id=${idProducto}`, {
                    method: 'DELETE'
                })
                .then(response => {
                    if (response.ok) {
                        console.log(`Producto con ID ${idProducto} eliminado correctamente`);
                        const productoAEliminar = event.target.closest('.crt-prd');
                        productoAEliminar.classList.add('erraseOut');
                        setTimeout(() => {
                            productoAEliminar.remove();
                        }, 500);
                        actualizarCarrito();
                        actualizarPrecio();
                        setTimeout(() => {
                            actualizarProductos();
                        }, 600);
                    } else {
                    console.error(`Ocurrió un error al eliminar el producto con ID ${idProducto}`);
                    }
                })
                .catch(error => {
                    console.error(`Ocurrió un error al eliminar el producto con ID ${idProducto}:`, error);
                });
            }
        </script>
    </div>
</div>       
<script>
    const exit = document.querySelectorAll('.bx-x');
    const modal = document.querySelector('.mdl');
    const frmUsr = document.querySelector('.lg-in');
    const frmSgn = document.querySelector('.sgn-up');
    const sgnUp = document.querySelector('.sgnUp');
    const sgnUp2 = document.querySelector('.sgnUp2');
    const frmRcv = document.querySelector('.rcvr');
    const forget = document.querySelector('.frgt');
    const forget2 = document.querySelector('.frgt2');
    const login = document.querySelector('.lgIn');
    const login2 = document.querySelector('.lgIn2');
    const shop = document.querySelector('.bxs-cart');
    const mdlCart = document.querySelector('.mdl-cart');
    const carrito = document.querySelector('.cart');
    const verMas = document.querySelectorAll('.bx-exit');
    const shopping = document.querySelector('.btnShop');
    const data = document.querySelector('.frmCliente');
    const data2 = document.querySelector('.frmDestino');
    const data3 = document.querySelector('.frmPago');
    const data4 = document.querySelector('.frmRecojo');
    const btnPago = document.querySelector('.nextPago');
    const btnBoleta = document.querySelector('.nextBoleta');
    const finalPrice = document.querySelector('.crt-ttl');
    const paid = document.querySelector('.pagado');
    const next = document.querySelector('.continuar');

    function formEnvio(){
        data.classList.remove('in');
        data2.style.display = 'flex';
        setTimeout(() => {
            data.style.display = 'none';
            data2.classList.add('in');
        }, 300);
    }

    let btnContacto = document.querySelector('.envContacto');
    btnContacto.addEventListener('click', enviarContacto);

    function enviarContacto(){
        let btn = this;
        let cart = this.closest('.endShop').querySelector('#carrito').value;
        let cont = btn.closest('.frmData');
        let tipo = cont.querySelector('#tipo').selectedIndex;
        let tipDoc = cont.querySelector('#tipo').value;
        let documento = cont.querySelector('#documento').value.trim();
        let nombre = cont.querySelector('#nombreCompleto').value.trim();
        let telefono = cont.querySelector('#telefono').value.trim();

        let regex9Digitos = /^\d{7,9}$/;
        let regexini9 = /^9\d{8}$/;

        let docuValido = regex9Digitos.test(documento);
        let telValido = regexini9.test(telefono);

        if (docuValido == false || telValido == false) {
            Swal.fire({
                icon: 'error',
                title: '¡ERROR!',
                text: 'Llene los datos correctamente para proseguir con la compra.'
            });
        }
        else {
            if (documento !== '' && nombre !== '' && telefono !== '' && tipo > 0) {
                
                formEnvio();

                const formData = new FormData();
                formData.append('cartShop', cart);
                formData.append('slcDoc', tipDoc);
                formData.append('numDoc', documento);
                formData.append('nomCon', nombre);
                formData.append('celCon', telefono);

                console.log(formData);

                fetch('/kartun/web/php/addContacto.php', {
                    method: "POST",
                    body: formData
                })
                .then(response =>{
                if (response.ok) {
                    return response.text();
                } else {
                    throw new Error("Error al agregar los datos.");
                }
                })
                .then(data => {
                    Swal.fire({
                    icon: 'success',
                    title: '¡OK!',
                    text: 'Datos agregados correctamente.'
                    });
                })
                .catch(error =>{
                    console.error(error);
                });
            } else {
                    Swal.fire({
                    icon: 'error',
                    title: '¡DATOS INCOMPLETOS!',
                    text: 'Debe llenar todos los datos para poder enviar la información.'
                    });
            }
        }
    }

    let depa = document.querySelector('#dprt');
    depa.addEventListener('change', actualizarProvincia);
        
    function actualizarProvincia(depa){
        var departamento = depa.target;
        var select = departamento.value;
        var provincia = departamento.closest('.frmData').querySelector('#prvnc');
        var delivery = departamento.closest('.mdl-cart').querySelector('#deliver');
        var selected = departamento.options[departamento.selectedIndex];
        var precio = selected.getAttribute('data-price');
        var estado = selected.getAttribute('data-status');
        console.log(departamento);
        console.log(select);
        console.log(provincia);

        if(estado === '1'){
            delivery.textContent = 'S/ ' + precio;
        } else {
            delivery.textContent = 'S/ 0.00';
        }

        fetch('/kartun/web/php/getProvincia.php?dep=' + select)
        .then(response => response.text())
        .then(html =>{
            provincia.innerHTML = html;
            resetearDistrito();
        });
    }

    let provi = document.querySelector('#prvnc');
    provi.addEventListener('change', actualizarDistrito);

    function actualizarDistrito(provi){
        var provincia = provi.target;
        var select = provincia.value;
        var distrito = provincia.closest('.frmData').querySelector('#dstr');
        fetch('/kartun/web/php/getDistrito.php?dis=' + select)
        .then(response => response.text())
        .then(html =>{
            distrito.innerHTML = html;
        });
    }

    function resetearDistrito(){
        var distrito = document.querySelector('#dstr');
        var defaultOption = document.createElement("option");
        defaultOption.text = "- - - - - - - -";
        defaultOption.selected = true;
        defaultOption.disabled = true;
        distrito.textContent = '';
        distrito.insertAdjacentElement('afterbegin',defaultOption);
    }

    let entrega = document.querySelector('#entrega');
    entrega.addEventListener('change', actualizarBoton);

    function actualizarBoton(){
        var select = this;
        const recojo = this.closest('.frmData').querySelectorAll('.hd');
        const envio = this.closest('.frmData').querySelectorAll('.hiden');
        const delivery = this.closest('.mdl-cart').querySelector('.crt-ttl').querySelector('.s-sub').querySelector('.sb-txs').querySelector('.tx-ttl').nextElementSibling.nextElementSibling.querySelector('#deliver');
        if (select.value == 'RECOJO') {
            delivery.textContent = 'S/ 0.00';   
            envio.forEach(env =>{
                env.style.display = 'flex';
            });
            recojo.forEach(reco =>{
                reco.style.display = 'none';
            });
            btnPago.addEventListener('click', sendRecojo);
            btnPago.removeEventListener('click', sendEnvio);
        } else if(select.value == 'ENVÍO') {
            recojo.forEach(reco =>{
                reco.style.display = 'flex';
            });
            envio.forEach(env =>{
                env.style.display = 'none';
            });
            btnPago.addEventListener('click', sendEnvio);
            btnPago.removeEventListener('click', sendRecojo);
        }
    }

    function sendEnvio(){
        var pago = btnPago;
        let tipEnt = pago.closest('.frmData').querySelector('#entrega').value;
        let deliver = pago.closest('.mdl-cart').querySelector('#deliver').textContent;
        let delivery = deliver.replace("S/ ", "");
        let depa = pago.closest('.frmData').querySelector('#dprt').value;
        let dep = pago.closest('.frmData').querySelector('#dprt').selectedIndex;
        let provi = pago.closest('.frmData').querySelector('#prvnc').value;
        let prov = pago.closest('.frmData').querySelector('#prvnc').selectedIndex;
        let dist = pago.closest('.frmData').querySelector('#dstr').value;
        let dis = pago.closest('.frmData').querySelector('#dstr').selectedIndex;
        let dir = pago.closest('.frmData').querySelector('#direccion').value;
        let ref = pago.closest('.frmData').querySelector('#referencia').value;
        let cart = pago.closest('.frmData').querySelector('#carrito').value;

        // console.log(pago);
        // console.log(delivery);
        // console.log(depa);
        // console.log(provi);
        // console.log(dist);
        // console.log(dir);
        // console.log(ref);
        // console.log(cart);

        if (dir !== '' && ref !== '' && dep > 0 && prov > 0 && dis > 0) {
                
            const formData = new FormData();
            formData.append('cartShop', cart);
            formData.append('slcEnt', tipEnt);
            formData.append('dlvr', delivery);
            formData.append('slcDep', depa);
            formData.append('slcPro', provi);
            formData.append('slcDis', dist);
            formData.append('dir', dir);
            formData.append('ref', ref);

            console.log(formData);

            fetch('/kartun/web/php/addEnvio.php', {
                method: "POST",
                body: formData
            })
            .then(response =>{
            if (response.ok) {
                return response.text();
            } else {
                throw new Error("Error al agregar los datos.");
            }
            })
            .then(data => {
                Swal.fire({
                icon: 'success',
                title: '¡OK!',
                text: 'Datos agregados correctamente.'
                });
            })
            .catch(error =>{
                console.error(error);
            });
        } else {
                Swal.fire({
                icon: 'error',
                title: '¡DATOS INCOMPLETOS!',
                text: 'Debe llenar todos los datos para poder enviar la información.'
                });
        }

        data2.classList.remove('in');
        data3.style.display = 'flex';
        setTimeout(() => {
            data2.style.display = 'none';
            data3.classList.add('in');
        }, 300);

        calcularTotal();
    }

    function sendRecojo(){
        var pago = btnPago;
        let tipEnt = pago.closest('.frmData').querySelector('#entrega').value;
        let deliver = pago.closest('.mdl-cart').querySelector('#deliver').textContent;
        let delivery = deliver.replace("S/ ", "");
        let depa = '';
        let provi = '';
        let dist = '';
        let dir = '';
        let ref = '';
        let cart = pago.closest('.frmData').querySelector('#carrito').value;

        // console.log(pago);
        // console.log(delivery);
        // console.log(depa);
        // console.log(provi);
        // console.log(dist);
        // console.log(dir);
        // console.log(ref);
        // console.log(cart);
                
        const formData = new FormData();
        formData.append('cartShop', cart);
        formData.append('slcEnt', tipEnt);
        formData.append('dlvr', delivery);
        formData.append('slcDep', depa);
        formData.append('slcPro', provi);
        formData.append('slcDis', dist);
        formData.append('dir', dir);
        formData.append('ref', ref);

        console.log(formData);

        fetch('/kartun/web/php/addEnvio.php', {
            method: "POST",
            body: formData
        })
        .then(response =>{
        if (response.ok) {
            return response.text();
        } else {
            throw new Error("Error al agregar los datos.");
        }
        })
        .then(data => {
        })
        .catch(error =>{
            console.error(error);
        });

        data2.classList.remove('in');
        data3.style.display = 'flex';
        setTimeout(() => {
            data2.style.display = 'none';
            data3.classList.add('in');
        }, 300);

        calcularTotal();
    }

    let pago = document.querySelector('#pago');
    pago.addEventListener('click', actualizarMetodo);

    function actualizarMetodo(){
            var select = this;
            var api = this.closest('.frmData').querySelector('.app');
            var trans = this.closest('.frmData').querySelector('.trs');
            if (select.value == "aplicativo") {
                api.style.display = "flex";
                trans.style.display = "none";
            } else if (select.value == "transferencia") {
                api.style.display = "none";
                trans.style.display = "flex";
            } else {
                api.style.display = "none";
                trans.style.display = "none";
            }
    }

    //MOSTRAR PSW
    const block = document.querySelectorAll('.locked');
        block.forEach(bk =>{
            bk.addEventListener('click', () => {
                const parentDiv = bk.closest('.lck');
                const input = parentDiv.querySelector('.wrd');
                if(input.type === "password"){
                    input.type = "text";
                    bk.classList.remove('bxs-lock');
                    bk.classList.add('bxs-lock-open');
                }else{
                    input.type = "password";
                    bk.classList.remove('bxs-lock-open');
                    bk.classList.add('bxs-lock');
                }
            });
    });

    //SALIR DE LOS FORMULARIOS
    exit.forEach(e => {
        e.addEventListener('click', () =>{
            modal.classList.add('hide');
            setTimeout(() => {
                modal.style.display = 'none';
                frmUsr.style.display = 'none';
                frmSgn.style.display = 'none';
                frmRcv.style.display = 'none';

            }, 350);
        });
    });

    sgnUp.addEventListener('click', () =>{
        frmSgn.classList.remove('hide');
        frmUsr.classList.add('hide');
        setTimeout(() => {
            frmSgn.style.display = 'flex';
            frmUsr.style.display = 'none';
        }, 350);
    });   

    forget.addEventListener('click', () =>{
        frmUsr.classList.add('hide');
        frmRcv.classList.remove('hide');
        setTimeout(() => {
            frmRcv.style.display = 'flex';
            frmUsr.style.display = 'none';
        }, 350);
    });  

    forget2.addEventListener('click', () =>{
        frmSgn.classList.add('hide');
        frmRcv.classList.remove('hide');
        setTimeout(() => {
            frmRcv.style.display = 'flex';
            frmSgn.style.display = 'none';
        }, 350);
    });  

    login.addEventListener('click', () =>{
        frmSgn.classList.add('hide');
        frmUsr.classList.remove('hide');
        setTimeout(() => {
            frmUsr.style.display = 'flex';
            frmSgn.style.display = 'none';
        }, 350);
    }); 

    login2.addEventListener('click', () =>{
        frmRcv.classList.add('hide');
        frmUsr.classList.remove('hide');
        setTimeout(() => {
            frmUsr.style.display = 'flex';
            frmRcv.style.display = 'none';
        }, 350);
    }); 

    sgnUp2.addEventListener('click', () =>{
        frmSgn.classList.remove('hide');
        frmRcv.classList.add('hide');
        setTimeout(() => {
            frmSgn.style.display = 'flex';
            frmRcv.style.display = 'none';
        }, 350);
    });   

    //MOSTRAR CARRITO
    shop.addEventListener('click', () =>{
        mdlCart.style.display = 'flex';
        mdlCart.style.opacity = '1';
        carrito.style.display = 'flex';
        setTimeout(() => {
            carrito.classList.add('moveLeft');
        }, 300);
    })

    verMas.forEach(vm => {
        vm.addEventListener('click', () =>{
            carrito.classList.remove('moveLeft');
            data.classList.remove('in');
            finalPrice.classList.remove('in');
            mdlCart.style.opacity = '0';
            setTimeout(() => {
                mdlCart.style.display = 'none';
                carrito.style.display = 'none';
                data.style.display = 'none';
                finalPrice.style.display = 'none';
            }, 300);
        });
    })

    shopping.addEventListener('click', () =>{
        <?php if (isset($_SESSION['usuario'])){?>
            <?php 
                $sql = "SELECT * FROM carrito WHERE clienteId = '$id' AND autorizado = true";
                $result = mysqli_query($conexion, $sql);
                $carrito = "";
                foreach ($result as $shop):
                $carrito = $shop['idCarrito'];
                endforeach;
                if ($carrito != "") {
                    $sql2 = "SELECT * FROM contacto WHERE carritoId = '$carrito'";
                    $respuesta =  mysqli_query($conexion, $sql2);
                    if(mysqli_num_rows($respuesta) > 0) {
            ?>
            //Si ya se agregó el contacto se pasa al formulario de envío
                totalPago();
                totalProductos();
                carrito.classList.remove('moveLeft');
                data2.style.display = 'flex';
                finalPrice.style.display = 'flex';
                setTimeout(() => {
                    carrito.style.display = 'none';
                    data2.classList.add('in');
                    finalPrice.classList.add('in');
                }, 300);
            <?php
                } else {
            ?>
            //Si no al formulario de contacto
                totalPago();
                totalProductos();
                carrito.classList.remove('moveLeft');
                data.style.display = 'flex';
                finalPrice.style.display = 'flex';
                setTimeout(() => {
                    carrito.style.display = 'none';
                    data.classList.add('in');
                    finalPrice.classList.add('in');
                }, 300);
            <?php 
                }
            }
            ?>  
            <?php 
                $sql3 = "SELECT * FROM envio WHERE carritoId = '$carrito'";
                $response =  mysqli_query($conexion, $sql3);
                if(mysqli_num_rows($response) > 0) {
            ?>   
            //Si ya se agregó el envío se pasa al formulario de pago
                totalPago();
                totalProductos();
                data2.classList.remove('in');
                data3.style.display = 'flex';
                setTimeout(() => {
                    data2.style.display = 'none';
                    data3.classList.add('in');
                }, 300);
                setTimeout(() => {
                    calcularTotal();
                }, 500);
            <?php } ?>
        <?php } ?>
    });
    

    function calcularTotal(){
        //Obtencion y modificación de datos
        let total = data2.closest('.mdl-cart').querySelector('#totalPagar');
        let subtotal = data2.closest('.mdl-cart').querySelector('#subTotalPago');
        let sbttl = subtotal.textContent.replace('S/ ','');
        let descuento = data2.closest('.mdl-cart').querySelector('#descTotal');
        let dsct = descuento.textContent.replace('S/ ','');
        let delivery = data2.closest('.mdl-cart').querySelector('#deliver');
        let dlv = delivery.textContent.replace('S/ ','');

        //Calculo del total a pagar
        let precioFinal;
        precioFinal = parseFloat(sbttl) + parseFloat(dlv) - parseFloat(dsct);
        let precioRound = precioFinal.toFixed(2);
        total.textContent = `S/ ${precioRound}`;

        console.log('Total Actualizado');
    }

    function totalProductos(){
        fetch('/kartun/web/php/updPrdsTotal.php')
        .then(response => response.text())
        .then(productosTotal => {
            const totalProductos = document.querySelector('.s-crt');
            totalProductos.innerHTML = productosTotal;
            console.log('Productos Actualizados');
        })
        .catch(error => {
            console.error('Ocurrió un error al actualizar el número de productos en el carrito:', error);
        });
    }

    function totalPago(){
        fetch('/kartun/web/php/updPagoTotal.php')
        .then(response => response.text())
        .then(totalPago => {
            const precioTotal = document.querySelector('.s-sub');
            precioTotal.innerHTML = totalPago;
            console.log('Precio Total Actualizado');
        })
        .catch(error => {
            console.error('Ocurrió un error al actualizar el precio total en el carrito:', error);
        });
    }

    btnBoleta.addEventListener('click', pagando);

    function pagando(){
        let boleta = btnBoleta;

        let tipOperacion = boleta.closest('.frmData').querySelector('#pago').value;
        let tipo = boleta.closest('.frmData').querySelector('#pago').selectedIndex;
        let numOperacion = boleta.closest('.frmData').querySelector('#numOpe').value;
        let titular = boleta.closest('.frmData').querySelector('#tituPago').value;
        let carrito = boleta.closest('.frmData').querySelector('#carrito').value;
        let delivery = boleta.closest('.frmPago').nextElementSibling.querySelector('#deliver').textContent.replace('S/ ','');
        let descuento = boleta.closest('.frmPago').nextElementSibling.querySelector('#descTotal').textContent.replace('S/ ','');
        let pago = boleta.closest('.frmPago').nextElementSibling.querySelector('#subTotalPago').textContent.replace('S/ ','');

        //Fecha actual
        let fechaHoy = new Date();
        // Obtener los componentes de la fecha y hora
        var year = fechaHoy.getFullYear(); // Año (ejemplo: 2023)
        var month = pad(fechaHoy.getMonth() + 1); // Mes (0-11, por lo que se agrega 1) (ejemplo: 05 para mayo)
        var day = pad(fechaHoy.getDate()); // Día del mes (ejemplo: 20)
        var hours = pad(fechaHoy.getHours()); // Horas (ejemplo: 13)
        var minutes = pad(fechaHoy.getMinutes()); // Minutos (ejemplo: 45)
        var seconds = pad(fechaHoy.getSeconds()); // Segundos (ejemplo: 30)
        //Asignar 0 a números menos a 10
        function pad(number) {
            return (number < 10 ? '0' : '') + number;
        }
        // Crear una cadena con el formato deseado (YYYY-MM-DD HH:MM:SS)
        var fechaHoraFormateada = year + '-' + month + '-' + day + ' ' + hours + ':' + minutes + ':' + seconds;

        // console.log(tipOperacion);
        // console.log(numOperacion);
        // console.log(titular);
        // console.log(carrito);
        // console.log(delivery);
        // console.log(descuento);
        // console.log(pago);
        // console.log(fechaHoraFormateada);

        let regex = /^\d{8}$/;

        if(regex.test(numOperacion)) {
            if (titular !== '' && numOperacion !== '' && tipo > 0) { 

                const formData = new FormData();
                formData.append('slcPago', tipOperacion);
                formData.append('nOpe', numOperacion);
                formData.append('titPago', titular);
                formData.append('ttlpg', pago);
                formData.append('dscttl', descuento);
                formData.append('dlvry', delivery);
                formData.append('cartShop', carrito);
                formData.append('fecha', fechaHoraFormateada);

                console.log(formData);

                fetch('/kartun/web/php/addPago.php', {
                    method: "POST",
                    body: formData
                })
                .then(response =>{
                if (response.ok) {
                    return response.text();
                } else {
                    throw new Error("Error al agregar los datos.");
                }
                })
                .then(data => {
                    Swal.fire({
                    icon: 'success',
                    title: '¡OK!',
                    text: 'Datos agregados correctamente.'
                    });
                })
                .catch(error =>{
                    console.error(error);
                });


                data3.classList.remove('in');
                finalPrice.classList.remove('in');
                paid.style.display = 'flex';
                setTimeout(() => {
                    data3.style.display = 'none';
                    finalPrice.style.display = 'none';
                    paid.style.opacity = '1';
                }, 300);

                actualizarCarrito();

             } else { 
                Swal.fire({
                icon: 'error',
                title: '¡DATOS INCOMPLETOS!',
                text: 'Debe llenar todos los datos para poder enviar la información.'
                });
            }
        } else {
            Swal.fire({
                icon: 'error',
                title: '¡ERROR!',
                text: 'Llene los datos correctamente para proseguir con la compra.'
            });
        }
    }

    next.addEventListener('click', () =>{
        mdlCart.style.opacity = '0';
        paid.style.opacity = '0';
        setTimeout(() => {
            paid.style.display = 'none';
            mdlCart.style.display = 'none';
        }, 300);
    })

    //VALIDAR NUMEROS
    function cambiarColor(input) {
        if (input.value === "") {
            input.style.boxShadow = "inset 0 0 0 .2vw white";
        } else if (isNaN(input.value)) {
            input.style.boxShadow = "inset 0 0 0 .2vw red";
        } else {
            input.style.boxShadow = "inset 0 0 0 .2vw green";
        }
    }

</script>