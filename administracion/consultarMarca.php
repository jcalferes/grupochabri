<?php

include './administracion.dao/dao.php';
$dao = new dao();
$datos = $dao->consultaMarca($cn);
echo"<div class='table-responsive'><table class='table table-hover'><thead><th>Editar</th><th>Marca</th></thead><tbody>";
while ($rs = mysql_fetch_array($datos)) {
    echo"<tr><td><input type='checkbox' id='eliminar' onclick='eliminar()'> <a id='editar' onclick='editar()'>Editar</a> </td>";
    echo"<td>$rs[1]</td>";
}
echo"</tbody></table></div>";


