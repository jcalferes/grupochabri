<?php

include './administracion.dao/dao.php';
$dao = new dao();
$datos = $dao->consultaMarca();
echo"<div class='table-responsive' ><table class='table table-hover' id='dtmarca'><thead><th></th><th>Marca</th></thead><tbody>";
while ($rs = mysql_fetch_array($datos)) {
    echo"<tr><td><center><input class='checkMarcas' type='checkbox' id='eliminar' onclick='eliminar()' value='$rs[idMarca]'></center></td>";
    echo"<td>$rs[marca]</td></tr>";
}
echo"</tbody></table></div>";


