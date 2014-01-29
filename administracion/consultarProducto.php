<?php

include './administracion.dao/dao.php';
$dao = new dao();
$datos = $dao->consultaProducto($cn);
echo"<div class='table-responsive'><table class='table table-hover'><thead><th>Editar</th><th>Producto</th><th>Proveedor</th><th>Marca</th><th>Costo</th><th>listaPrecio</th><th>Tarifa</th></thead><tbody>";
while ($rs = mysql_fetch_array($datos)) {
    echo"<tr><td><input type='checkbox' id='eliminar' onclick='eliminar()'> <a id='editar' onclick='editar()'>Editar</a> </td>";
    echo"<td >$rs[idProducto]</td>";
    echo"<td>$rs[producto]</td>";
    echo"<td id='$rs[idMarca]' >$rs[idMarca] </td>";
    echo"<td>$rs[idProveedor]</td>";
    echo"<td>$rs[idListaPrecio]</td>";
    echo"<td>$rs[codigoProducto]</td></tr>";
}
echo"</tbody></table></div>";

