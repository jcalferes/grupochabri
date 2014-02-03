<?php

include './administracion.dao/dao.php';
$dao = new dao();
$datos = $dao->consultaProducto();
echo"<div class='table-responsive'><table class='table table-hover'><thead><th>Editar</th><th>Producto</th><th>Proveedor</th><th>Marca</th><th>Costo</th></thead><tbody>";
while ($rs = mysql_fetch_array($datos)) {
    echo"<tr><td><a onclick='gestionTarifas(" . "\"$rs[4]\"" . "," . "\"$rs[0]\"" . ")' >PrecioVenta</a></td>";
    echo"<td >$rs[0]</td>";
    echo"<td>$rs[1]</td>";
    echo"<td id='$rs[2]' >$rs[2] </td>";
    echo"<td>$rs[3]</td>";
}
echo"</tbody></table></div>";
