<?php

include './administracion.dao/dao.php';
$dao = new dao();
$datos = $dao->consultaProveedor();
echo"<div class='table-responsive'><table cellpadding='0' cellspacing='0' border='0' class='table table-hover table-bordered' id='dtproveedor'><thead><th>Nombre</th><th>Direccion</th><th>RFC</th><th>Dias de Credito</th><th>Email</th><th>Desct. Factura</th><th>Desct. Pronto Pago</th></thead><tbody>";
while ($rs = mysql_fetch_array($datos)) {
    echo"<tr><td>".utf8_encode($rs["nombre"])."</td>";
    echo"<td><button type='button' class='btn btn-xs btn-default' id='btnver' onclick='verDireccion($rs[idDireccion])' data-toggle='modal' data-target='#mdlverdireccion'><span class='glyphicon glyphicon-eye-open'></span></button></td>";
    echo"<td>$rs[rfc]</td>";
    echo"<td>$rs[diasCredito]</td>";
    echo"<td>$rs[email]</td>";
    echo"<td>$rs[descuentoPorFactura]</td>";
    echo"<td>$rs[descuentoPorProntoPago]</td></tr>";
}
echo"</tbody></table></div>";
