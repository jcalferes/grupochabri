<?php

include_once './administracion.dao/dao.php';
$dao = new dao();
$rfc = $_GET["rfc"];
$datos = $dao->obtieneTodosProductos($rfc);
echo"<div class='table-responsive'><table cellpadding='0' cellspacing='0' border='0' class='table table-hover table-bordered' id='dtproductoid'><thead><th>Codigo</th><th>Descripcion</th></thead><tbody>";
while ($rs = mysql_fetch_array($datos)) {
    echo"<tr><td>$rs[codigoProducto]</td>";
    echo"<td>$rs[producto]</td></tr>";
}
echo"</tbody></table></div>";

