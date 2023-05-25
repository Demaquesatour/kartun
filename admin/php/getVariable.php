<?php
session_start();
include './bd.php';

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
        <i id="eliminar" class='bx bxs-trash-alt'></i>
    </td>
</tr>
<tr class="updt-data">
    <td>
        EDITANDO
        <input id="ide" name="idnt" type="hidden" value="<?php echo $mostrar['idVariante'] ?>">
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
<?php mysqli_close($conexion); ?>