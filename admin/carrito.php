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
            <h1>Panel de Pedidos</h1>
        </div>
        <div class="fccc c-data">
            <table class="c-table">
                    <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Fecha</th>
                                <th scope="col">Monto</th>
                                <th scope="col">Tipo de Pago</th>
                                <th scope="col">N° de Operación</th>
                                <th scope="col">Titular</th>
                                <th scope="col">Estado</th>
                                <th scope="col">Opciones</th>
                            </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $sql = "SELECT * FROM pedido p INNER JOIN carrito c ON p.carritoId = c.IdCarrito";
                            $result = mysqli_query($conexion,$sql);
                            while($mostrar = mysqli_fetch_array($result)){
                        ?>
                        <tr>
                            <td class="fcc">
                                <?php echo $mostrar['idPedido'] ?>
                                <input id="identidad" type="hidden" name="idstd" value="<?php echo $mostrar['idPedido'] ?>">
                                <input id="carrito" type="hidden" name="idshop" value="<?php echo $mostrar['carritoId'] ?>">
                            </td>
                            <td class="fcc"><?php echo $mostrar['fecha'] ?></td>
                            <td class="fcc"><?php echo $mostrar['monto'] ?></td>
                            <td class="fcc"><?php echo $mostrar['tipPago'] ?></td>
                            <td class="fcc"><?php echo $mostrar['nroOpe'] ?></td>
                            <td class="fcc"><?php echo $mostrar['titular'] ?></td>
                            <?php 
                                $estado = $mostrar['estado'];
                                if($estado === 'PENDIENTE'){
                                ?>  
                                    <td class="fcc">
                                        <select name="stdCart" id="estado">
                                            <option selected disabled value="<?php echo $mostrar['estado'] ?>"><?php echo $mostrar['estado'] ?></option>
                                            <option value="ACEPTADO">ACEPTADO</option>
                                            <option value="CANCELADO">CANCELADO</option>
                                        </select>
                                    </td>
                                    <td class="fsc opt">
                                        <button class="update">ACTUALIZAR</button>
                                        <a class="fcc"><i id="eliminar" class='bx bxs-trash-alt'></i></a>
                                    </td>
                                <?php } else { ?>
                                    <td class="fcc"><?php echo $mostrar['estado'] ?></td>
                                    <td class="fsc opt">
                                        <button style="background-color: #6c757d;">ACTUALIZADO</button>
                                        <a class="fcc"><i id="eliminar" class='bx bxs-trash-alt'></i></a>
                                    </td>
                            <?php } ?>
                        </tr>
                        <?php
                        } 
                        ?>
                    </tbody>
            </table>
        </div>
    </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', eventosCarrito);


        function eventosCarrito(){
            let botones = document.querySelectorAll('.update');
            botones.forEach(boton =>{
            boton.addEventListener('click', actualizarEstado);
            });
        }

        function actualizarEstado(){
            let btn = this;
            let id = btn.closest('tr').querySelector('#identidad').value;
            let shopid = btn.closest('tr').querySelector('#carrito').value;
            let estado = btn.closest('tr').querySelector('#estado').value;
            // console.log(id);
            // console.log(shopid);
            // console.log(estado);

            // getEstado(btn);

            const formData = new FormData();
            formData.append('idstd', id);
            formData.append('idshop', shopid);
            formData.append('stdCart', estado);

            console.log(formData);

            fetch('./php/pdtEstado.php', {
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
                text: 'Estado actualizado correctamente.'
                });
                getEstado(btn);
            })
            .catch(error =>{
                console.error(error);
            });
        }

        function getEstado(btn){
            let estado = btn;
            let body = btn.closest('tbody');
            fetch('/kartun/admin/php/getEstado.php')
            .then(response => response.text())
            .then(html => {
                body.innerHTML = html;
                eventosCarrito();
            });
        }

    </script>
</body>
</html>