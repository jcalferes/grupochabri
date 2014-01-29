<?php

include './administracion.dao/dao.php';
$dao = new dao();
$datos = $dao->consultaProveedor($cn);
echo"<div class='table-responsive'><table class='table table-hover'><thead><th>Editar</th><th>Nombre</th><th>Id Direccion</th><th>RFC</th><th>Dias de Credito</th><th>Descuento</th></thead><tbody>";
while ($rs = mysql_fetch_array($datos)) {
    echo"<tr><td><input type='checkbox' id='eliminar' onclick='eliminar()'> <a id='editar' onclick='editar()'>Editar</a> </td>";
    echo"<td>$rs[nombre]</td>";
    echo"<td>$rs[idDireccion]</td>";
    echo"<td>$rs[rfc]</td>";
    echo"<td>$rs[diasCredito]</td>";
    echo"<td>$rs[descuento]</td>";
    
}
echo"</tbody></table></div>";
