<?php
session_start();
include './bd.php';
$idDstr = $_GET['dis'];
$sql = "SELECT * FROM distritos WHERE provinciaId = '$idDstr'";
$result = mysqli_query($conexion,$sql);
?>
    <option disabled selected>SELECCIONE</option>
<?php foreach ($result as $opt): ?>
    <option value="<?php echo $opt['idDistrito'];?>"><?php echo $opt['distrito'];?></option>
<?php endforeach ?>
<?php mysqli_close($conexion); ?>