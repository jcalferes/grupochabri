<?php

include './administracion.dao/dao.php';
$dao = new dao();
$datos = $dao->consultaProveedor();
echo"<div class='table-responsive'><table cellpadding='0' cellspacing='0' border='0' class='table table-hover table-bordered' id='dtproveedor'><thead><th>Editar</th><th>Nombre</th><th>Id Direccion</th><th>RFC</th><th>Dias de Credito</th><th>Descuento</th><th>Email</th></thead><tbody>";
while ($rs = mysql_fetch_array($datos)) {
    
    echo"<tr><td><input type='checkbox' id='eliminar' onclick='eliminar()'> <a id='editar' onclick='editar()'>Editar</a> </td>";
    echo"<td>$rs[nombre]</td>";
    echo"<td>$rs[idDireccion]</td>";
    echo"<td>$rs[rfc]</td>";
    echo"<td>$rs[diasCredito]</td>";
    echo"<td>$rs[descuento]</td>";
    echo"<td>$rs[email]</td>";
}
echo"</tbody></table></div>";
