<?php

include './administracion.dao/dao.php';
$dao = new dao();
$datos = $dao->consultaProducto();
$comprobar = "";

echo"<center><button type='button' class='btn btn-xs btn-default' id='btnver' onclick='eliminarProductos()'><span class='glyphicon glyphicon-map-marker'></span></button></cente><div class='table-responsive'><table id='tdProducto' cellpadding='0' cellspacing='0' border='0' class='table table-hover table-bordered'><thead><th>Editar</th><th>Producto</th><th>Codigo</th><th>Marca</th><th>Costo</th><th>Fecha Mov.</th><th>Existencia</th><th>List. Precios</th></thead><tbody>";
while ($rs = mysql_fetch_array($datos)) {
    $comillas = str_replace("\"", "\\\"", $rs['producto']);
    echo"<tr><td><input type='checkbox' id='eliminar' value='$rs[codigoProducto]'><input  type='button' id ='detalleTarifa' class='btn btn-primary' data-dismiss='modal' data-toggle='modal' data-target='#mdlDetalleTarifa' value='+' style='display: none;'/></td> ";
    echo"<td >$rs[producto]</td>";
    $comprobar = $rs['codigoProducto'];
    echo"<td>$rs[codigoProducto]</td>";
//     echo"<td id='$rs[folioProducto]' >$rs[folioProducto] </td>";
    echo"<td id='$rs[marca]' >$rs[marca] </td>";
    echo"<td id='$rs[costo]' >$rs[costo] </td>";
    echo"<td id='$rs[fechaMovimiento]' >$rs[fechaMovimiento] </td>";
    echo"<td id='$rs[cantidad]' >$rs[cantidad] </td>";

    echo "<td><a onclick='gestionTarifas(" . "\"$rs[codigoProducto]\"" . "," . "\"$comillas\"" . ")' >detalles</a></td></tr>";
}
echo"</tbody></table></div>";

