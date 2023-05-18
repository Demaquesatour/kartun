<?php
session_start();
include './bd.php';
$idDprt = $_GET['dep'];
$sql = "SELECT * FROM provincias WHERE departamentoId = '$idDprt'";
$result = mysqli_query($conexion,$sql);
?>
    <option disabled selected>SELECCIONE</option>
<?php foreach ($result as $opt): ?>
    <option value="<?php echo $opt['idProvincia'];?>"><?php echo $opt['provincia'];?></option>
<?php endforeach ?>
<?php mysqli_close($conexion); ?>