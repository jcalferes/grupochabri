<?php
include_once './administracion.dao/dao.php';
$dao= new dao();
$datos=$dao->consultaOrdenesLista();
//echo "<center><button type='button' class='btn btn-xs btn-default' id='btnver' onclick='eliminarProveedores()'><span class='glyphicon glyphicon-trash'></span></button></center>";
echo"<div class='table-responsive'><table class='table table-hover' id='dtproveedor'><thead><th>Folio</th><th>Proveedor</th><th>Fecha</th><th>total</th><th>Desct. Gral Total</th><th>Detalles</th></thead><tbody>";
while ($rs = mysql_fetch_array($datos)) {
    echo "<tr><td>$rs[idXmlComprobante]</td>";
    echo"<td>$rs[rfcComprobante]</td>";
    echo"<td>$rs[fechaMovimiento]</td>";
    echo"<td>$rs[totalComprobante]</td>";
    echo"<td>$rs[desctTotalComprobante]</td>";
//    echo"<td>Nada</td></tr>";
    echo"<td><center><button type='button' class='btn btn-xs' id='btnver' onclick='verOrdenCompra($rs[idXmlComprobante])'><span class='glyphicon glyphicon-info-sign'></span></button></center></td></tr>";
}
echo"</tbody></table></div>";
