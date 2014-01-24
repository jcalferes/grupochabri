<?php

include './administracion.dao/dao.php';
$dao = new dao();
$datos = $dao->consultaProducto($cn);
echo"<div class='table-responsive'><table class='table table-hover'><thead><th>Editar</th><th>Producto</th><th>Proveedor</th><th>Marca</th><th>Costo</th><th>listaPrecio</th><th>Tarifa</th></thead><tbody>";
while ($rs = mysql_fetch_array($datos)) {
    echo"<tr><td><input type='checkbox' id='eliminar' onclick='eliminar()'> <a id='editar' onclick='editar()'>Editar</a> </td>";
    echo"<td >$rs[0]</td>";
    echo"<td>$rs[1]</td>";
    echo"<td id='$rs[2]' >$rs[2] </td>";
    echo"<td>$rs[3]</td>";
    echo"<td>$rs[4]</td>";
    echo"<td>$rs[5]</td></tr>";
}
echo"</tbody></table></div>";

