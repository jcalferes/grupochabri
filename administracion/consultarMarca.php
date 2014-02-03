<?php

include './administracion.dao/dao.php';
$dao = new dao();
$datos = $dao->consultaMarca();
echo"<div class='table-responsive'><table cellpadding='0' cellspacing='0' border='0' class='table table-hover table-bordered' id='dtmarca'><thead><th>Editar</th><th>Marca</th></thead><tbody>";
while ($rs = mysql_fetch_array($datos)) {
    echo"<tr><td><input type='checkbox' id='eliminar' onclick='eliminar()'> <a id='editar' onclick='editar()'>Editar</a> </td>";
    echo"<td>$rs[marca]</td>";
}
echo"</tbody></table></div>";


