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
                        $id = $_GET['id'];
                        $sql = "SELECT * FROM variante WHERE `productoId` = '$id'";
                        $result = mysqli_query($conexion,$sql);
                        while($mostrar = mysqli_fetch_array($result)){
                    ?>
                    <tr>
                        <td><?php echo $mostrar['idVariante'] ?></td>
                        <td><?php echo $mostrar['descripcion'] ?></td> 
                        <td class="opt">
                            <i id="editar" class='bx bxs-cog edt'></i>
                            <i id="eliminar" class='bx bxs-trash-alt dlt'></i>
                        </td>
                    </tr>
                    <tr class="updt-data">
                        <td>
                            EDITANDO
                            <input id="ide" name="idnt" type="hidden" value="<?php echo $mostrar['idVariante'] ?>">
                            <input id="prd" type="hidden" value="<?php echo $id; ?>">
                        </td>
                        <td><input id="valor" name="vlr" type="text" value="<?php echo $mostrar['descripcion'] ?>"></td>
                        <td>
                            <button class="b-updt">ACTUALIZAR</button>
                            <button class="b-cncl">CANCELAR</button>
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
    <script>
        window.addEventListener('DOMContentLoaded', eventosVariante);

        function getVariable(tb){
            let dlv = tb;
            let body = dlv.closest('tbody');
            let id = body.querySelector('.updt-data').querySelector('#prd').value;

            // console.log(id);

            fetch('./php/getVariable.php?id='+id)
            .then(response => response.text())
            .then(table =>{
                body.innerHTML = table;
                eventosVariante();
            });
        }
        
        function eventosVariante(){
            const rueda = document.querySelectorAll('.edt');
            const tacho = document.querySelectorAll('.dlt');
            const btnUpdt = document.querySelectorAll('.b-updt');
            const btnCncl = document.querySelectorAll('.b-cncl');

            rueda.forEach(rd =>{
                rd.addEventListener('click', abrirEditar);
            });

            tacho.forEach(tch =>{ 
                tch.addEventListener('click', dltVar);
            })

            btnCncl.forEach(bccl =>{
                bccl.addEventListener('click', clsEditar);
            });

            btnUpdt.forEach(upd =>{
                upd.addEventListener('click', edtVar);
            });
        }

        function abrirEditar(){
            let icon = this;
            let tb = icon.closest('tr').nextElementSibling;
            tb.style.display = 'table-row';
            // console.log(tb);
        }

        function clsEditar(){
            let btn = this;
            let tb = btn.closest('tr');
            tb.style.display = 'none';
            // console.log(tb);
        }

        function edtVar(){
            let btn = this;
            let tb = btn.closest('tr');
            let id = tb.querySelector('#ide').value;   
            let valor = tb.querySelector('#valor').value;

            // console.log(id);
            // console.log(valor);
            // getVariable(tb);

            const formData = new FormData();
            formData.append('idnt', id);
            formData.append('vlr', valor);
            console.log(formData);

            fetch('/kartun/admin/editVariable.php', {
                method: "POST",
                body: formData
            })
            .then(response =>{
            if (response.ok) {
                return response.text();
            } else {
                throw new Error("Error al agregar la categoría.");
            }
            })
            .then(data => {
                getVariable(tb);
                Swal.fire({
                icon: 'success',
                title: '¡OK!',
                text: 'La varaible se actualizó correctamente.'
                });
            })
            .catch(error =>{
                console.error(error);
            });
        }

        function dltVar(){
            let icon = this;
            let tb = icon.closest('tr').nextElementSibling;
            let idt = tb.querySelector('#ide').value;

            // getVariable(tb);
            // console.log(idt);

            const formData = new FormData();
            formData.append('idnt', idt);
            console.log(formData);

            fetch('/kartun/admin/delVariable.php', {
                method: "POST",
                body: formData
            })
            .then(response =>{
            if (response.ok) {
                return response.text();
            } else {
                throw new Error("Error al agregar la categoría.");
            }
            })
            .then(data => {
                getVariable(tb);
                Swal.fire({
                icon: 'success',
                title: '¡OK!',
                text: 'La varaible se elimin+o correctamente.'
                });
            })
            .catch(error =>{
                console.error(error);
            });
        }
    </script>
</body>
</html>