<?php
session_start();
include './bd.php';

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
<?php mysqli_close($conexion); ?>