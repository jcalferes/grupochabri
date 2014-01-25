<?php

include './administracion.dao/dao.php';
$dao = new dao();
$datos = $dao->consultaProveedor($cn);
echo"<div class='table-responsive'><table class='table table-hover'><thead><th>Editar</th><th>Nombre</th><th>Id Direccion</th><th>RFC</th><th>Dias de Credito</th><th>Descuento</th></thead><tbody>";
while ($rs = mysql_fetch_array($datos)) {
    echo"<tr><td><input type='checkbox' id='eliminar' onclick='eliminar()'> <a id='editar' onclick='editar()'>Editar</a> </td>";
    echo"<td>$rs[1]</td>";
    echo"<td>$rs[2]</td>";
    echo"<td>$rs[3]</td>";
    echo"<td>$rs[4]</td>";
    echo"<td>$rs[4]</td>";
    
}
echo"</tbody></table></div>";
