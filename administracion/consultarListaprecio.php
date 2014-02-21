<?php

include_once './administracion.dao/dao.php';
$dao = new dao();
$datos = $dao->consultaListaPrecio();
echo"<div class='table-responsive'><table cellpadding='0' cellspacing='0' border='0' class='table table-hover table-bordered' id='dtlistaprecios'><thead><th>Editar</th><th>Nombre</th></thead><tbody>";
while ($rs = mysql_fetch_array($datos)) {
    echo"<tr><td><input type='checkbox' id='eliminar' onclick='eliminar()'> <a id='editar' onclick='editar()'>Editar</a> </td>";
    echo"<td>$rs[nombreListaPrecio]</td>";
}
echo"</tbody></table></div>";
