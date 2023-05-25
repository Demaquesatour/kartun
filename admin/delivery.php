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
            <h1>Panel de Envío</h1>
        </div>
        <div class="fccc c-data">
            <table class="c-table">
                <thead>
                    <tr>
                        <th scope="col">Departamento</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Delivery</th>
                        <th scope="col">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $sql = "SELECT * FROM departamentos";
                        $result = mysqli_query($conexion,$sql);
                        foreach ($result as $opt):
                    ?>
                    <tr class="dsc-dt">
                        <td><?php echo $opt['departamento'];?></td>
                        <td><?php echo $opt['precio'];?></td>
                        <?php
                            $estado = $opt['status'];
                            if ($estado === '1'){
                                ?>
                                <td>COSTO</td>
                                <?php
                            } else {
                                ?>
                                <td>GRATIS</td>
                                <?php
                            }
                        ?>
                        <td><i id="editar" class='bx bxs-cog edt'></i></td>
                    </tr>
                    <tr class="updt-data">
                        <td>EDITAR</td>
                        <td>
                            <input id="id" name="dlvId" value="<?php echo $opt['idDepartamento']; ?>" type="hidden">
                            <input id="prc" type="number" step="0000.01" min="1" max="10000" name="dlvPrc" value="<?php echo $opt['precio'];?>">
                        </td>
                        <td>
                            <select id="stt" name="dlvStt">
                                    <option disabled selected value="">OPCIONES</option>
                                    <option value="0">GRATIS</option>
                                    <option value="1">COSTO</option>
                            </select>
                        </td>
                        <td>
                            <button class="b-updt">ACTUALIZAR</button>
                            <button class="b-cncl">CANCELAR</button>
                        </td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
    <script>
        function getDelivery(cont){
            let dlv = cont;
            let body = dlv.closest('tbody');
            // console.log(body);
            fetch('./php/getEnvio.php')
            .then(response => response.text())
            .then(table =>{
                body.innerHTML = table;
                eventosDistrito();
            });
        }

        window.addEventListener('DOMContentLoaded', eventosDistrito);
        function eventosDistrito(){
            const editData = document.querySelectorAll('.edt');
            editData.forEach(edt =>{
                edt.addEventListener('click', abrirEdit);
            });
            const cnclData = document.querySelectorAll('.b-cncl');
            cnclData.forEach(ccl =>{
                ccl.addEventListener('click', clsEdit);
            });
            const pdtData = document.querySelectorAll('.b-updt');
            pdtData.forEach(pdt =>{
                pdt.addEventListener('click', updtData);
            });
        }

        function abrirEdit(){
            let icon = this;
            let data = icon.closest('tr').nextElementSibling;
            data.style.display = 'table-row';

            // console.log(data);
        }

        function clsEdit(){
            let btn = this;
            let edit = btn.closest('tr');
            edit.style.display = 'none';

            // console.log(edit);
        }

        function updtData(){
            let editar = this;
            let cont = editar.closest('tr');
            let id = cont.querySelector('#id').value;
            let precio = cont.querySelector('#prc').value;
            let estado = cont.querySelector('#stt').value;
            
            // console.log(id);
            // console.log(precio);
            // console.log(estado);
            // getDelivery(cont);

            const formData = new FormData();
            formData.append('dlvId', id);
            formData.append('dlvPrc', precio);
            formData.append('dlvStt', estado);
            console.log(formData);

            fetch('/kartun/admin/editEnvio.php', {
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
                getDelivery(cont);
                Swal.fire({
                icon: 'success',
                title: '¡OK!',
                text: 'El envio se actualizó correctamente.'
                });
            })
            .catch(error =>{
                console.error(error);
            });
        }


    </script>
</body>
</html>