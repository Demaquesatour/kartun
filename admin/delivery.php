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
            <h1>Panel de Delivery</h1>
        </div>
        <div class="fccc c-data">
            <div class="c-agregar">
                <form class="fcc" action="agregarCat.php" method="POST">
                    <div class="fcsc c-input">
                        <p>Departamentos</p>
                        <select id="dprt">
                            <option selected disabled>SELECCIONE</option>
                            <?php 
                                $sql = "SELECT * FROM departamentos";
                                $result = mysqli_query($conexion,$sql);
                            ?>
                            <?php foreach ($result as $opt): ?>
                            <option value="<?php echo $opt['idDepartamento'];?>"><?php echo $opt['departamento'];?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="fcsc c-input">
                        <p>Provincias</p>
                        <select name="provincia" id="prvnc">
                            <option selected disabled>- - - - - - - -</option>
                        </select>
                    </div>
                    <div class="fcsc c-input">
                        <p>Distritos</p>
                        <select name="distrito" id="dstr">
                            <option selected disabled>- - - - - - - -</option>
                        </select>
                    </div>
                </form>
            </div>
            <table class="c-table">
                    <thead>
                            <tr>
                                <th scope="col">Ubicación</th>
                            </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $sql = "SELECT * FROM departamentos";
                            $result = mysqli_query($conexion,$sql);
                            while($mostrar = mysqli_fetch_array($result)){
                        ?>
                        <tr>
                            <td><?php echo $mostrar['departamento'];?></td>
                        </tr>
                        <?php
                        } 
                        ?>
                    </tbody>
            </table>
        </div>
    </div>
    <script>
        let depa = document.querySelector('#dprt');
        depa.addEventListener('change', actualizarProvincia);
        
        function actualizarProvincia(depa){
            var departamento = depa.target;
            var select = departamento.value;
            var provincia = departamento.closest('.fcsc').nextElementSibling.querySelector('#prvnc');
            fetch('./php/getProvincia.php?dep=' + select)
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
            var distrito = provincia.closest('.fcsc').nextElementSibling.querySelector('#dstr');
            fetch('./php/getDistrito.php?dis=' + select)
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
    </script>
</body>
</html>