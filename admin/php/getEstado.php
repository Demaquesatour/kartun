<?php
session_start();
include './bd.php';
$sql = "SELECT * FROM pedido";
$result = mysqli_query($conexion,$sql);
while($mostrar = mysqli_fetch_array($result)){
?>
<tr>
<td class="fcc">
    <?php echo $mostrar['idPedido'] ?>
    <input id="identidad" type="hidden" name="idstd" value="<?php echo $mostrar['idPedido'] ?>">
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
<?php mysqli_close($conexion); ?>