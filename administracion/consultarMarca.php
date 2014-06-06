<?php

include './administracion.dao/dao.php';
$dao = new dao();
$datos = $dao->consultaMarca();
echo"<div class='table-responsive' ><table class='table table-hover' id='dtmarca'><thead><th>Marca</th></thead><tbody>";
while ($rs = mysql_fetch_array($datos)) {
    echo"<tr>";
    echo"<td>$rs[marca]</td></tr>";
}
echo"</tr></tbody></table></div>";


