<?php
session_start();
include_once './administracion.dao/dao.php';
$dao= new dao();
$tipo = $_GET["tipo"];
$idsucursal = $_SESSION["sucursalSesion"];
$datos=$dao->consultaOrdenesLista($tipo,$idsucursal);
//echo "<center><button type='button' class='btn btn-xs btn-default' id='btnver' onclick='eliminarProveedores()'><span class='glyphicon glyphicon-trash'></span></button></center>";
if($tipo == "ORDEN COMPRA"){
    echo"<div class='table-responsive'><table class='table table-hover' id='dtproveedor'><thead><th>Folio</th><th>rfc</th><th>Proveedor</th><th>Fecha</th><th>total</th><th>Desct. Gral Total</th><th>Detalles</th></thead><tbody>";
while ($rs = mysql_fetch_array($datos)) {
    echo "<tr  style='text-align: right'><td>$rs[folioComprobante]</td>";
    echo"<td>$rs[rfcComprobante]</td>";
     echo"<td>$rs[nombre]</td>";
    echo"<td>$rs[fechaMovimiento]</td>";
    echo"<td  style='text-align: right'>$".number_format($rs["totalComprobante"], 2)."</td>";
    echo"<td  style='text-align: right'>$".number_format($rs["desctTotalComprobante"], 2)."</td>";
//    echo"<td>Nada</td></tr>";
    echo"<td><center><button type='button' class='btn btn-xs' id='btnver' onclick='verOrdenCompra($rs[folioComprobante],\"$tipo\")'><span class='glyphicon glyphicon-info-sign'></span></button></center></td></tr>";
}
echo"</tbody></table></div>";
}else{
    echo"<div class='table-responsive'><table class='table table-hover' id='dtproveedor'><thead><th>Folio</th><th>Sucursal</th><th>Fecha</th><th>total</th><th>Detalles</th></thead><tbody>";
while ($rs = mysql_fetch_array($datos)) {
    echo "<tr><td  style='text-align: right'>$rs[folioComprobante]</td>";
    echo"<td>$rs[sucursal]</td>";
    echo"<td>$rs[fechaMovimiento]</td>";
    echo"<td  style='text-align: right'>$".number_format($rs["totalComprobante"], 2)."</td>";
//    echo"<td>$rs[desctTotalComprobante]</td>";
//    echo"<td>Nada</td></tr>";
    echo"<td><button type='button' class='btn btn-xs' id='btnver' onclick='verOrdenCompra($rs[folioComprobante],\"$tipo\")'><span class='glyphicon glyphicon-info-sign'></span></button></td></tr>";
}
echo"</tbody></table></div>";
}


