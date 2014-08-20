<?php

include_once './administracion.dao/dao.php';
$dao = new dao();
$datos = $dao->consultaListaPrecio();
echo"<div class='table-responsive'><table class='table table-hover' id='dtlistaprecios'><thead><th>Nombre</th></thead><tbody>";
while ($rs = mysql_fetch_array($datos)) {
    echo"<tr>";
    echo"<td>$rs[nombreListaPrecio]</td>";
}

echo"</tr></tbody></table></div>";
