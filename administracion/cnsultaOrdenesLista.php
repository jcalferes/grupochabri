<?php

session_start();
include_once './administracion.dao/dao.php';
$dao = new dao();
$tipo = $_GET["tipo"];
$idsucursal = $_SESSION["sucursalSesion"];
$datos = $dao->consultaOrdenesLista($tipo, $idsucursal);
if ($tipo == "ORDEN COMPRA") {
    echo"<div class='table-responsive'><table class='table table-hover' id='dtproveedor'><thead><th>Folio</th><th>Rfc</th><th>Proveedor</th><th>Fecha</th><th>Total</th><th>Desct. Gral Total</th><th>Detalles</th></thead><tbody>";
    while ($rs = mysql_fetch_array($datos)) {
        echo "<tr><td>$rs[folioComprobante]</td>";
        echo"<td>$rs[rfcComprobante]</td>";
        echo"<td>$rs[nombre]</td>";
        echo"<td>$rs[fechaMovimiento]</td>";
        echo"<td  style='text-align: right'>$" . number_format($rs["totalComprobante"], 2) . "</td>";
        echo"<td  style='text-align: right'>$" . number_format($rs["desctTotalComprobante"], 2) . "</td>";
        echo"<td><center><button type='button' class='btn btn-xs' id='btnver' onclick='verOrdenCompra($rs[folioComprobante],\"$tipo\")'><span class='glyphicon glyphicon-info-sign'></span></button></center></td></tr>";
    }
    echo"</tbody></table></div>";
} else {
    echo"<div class='table-responsive'><table class='table table-hover' id='dtproveedor'><thead><th>Folio</th><th>Sucursal</th><th>Fecha</th><th>Total</th><th>Detalles</th></thead><tbody>";
    while ($rs = mysql_fetch_array($datos)) {
        echo "<tr><td>$rs[folioComprobante]</td>";
        echo"<td>$rs[sucursal]</td>";
        echo"<td>$rs[fechaMovimiento]</td>";
        echo"<td  style='text-align: right'>$" . number_format($rs["totalComprobante"], 2) . "</td>";
        echo"<td><center><button type='button' class='btn btn-xs' id='btnver' onclick='verOrdenCompra($rs[folioComprobante],\"$tipo\")'><span class='glyphicon glyphicon-info-sign'></span></button></center></td></tr>";
    }
    echo"</tbody></table></div>";
}


