<?php
session_start();
include './administracion.dao/dao.php';
$dao = new dao();
$idsucursal = $_SESSION["sucursalSesion"];
$datos = $dao->consultaGranel($idsucursal);
echo"<div class='table-responsive' ><table class='table table-hover' id='dtgranel'><thead><th>Codigo</th><th>Nombre</th><th>Cantidad disponible</th></thead><tbody>";
while ($rs = mysql_fetch_array($datos)) {
    echo"<tr><td>$rs[codigoProducto]</td>";
    echo"<td>$rs[producto]</td>";
    echo"<td>$rs[cantidad] Lt/Kg</td></tr>";
}
echo"</tbody></table></div>";

