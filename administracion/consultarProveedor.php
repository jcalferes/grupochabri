<?php

include './administracion.dao/dao.php';
$dao = new dao();
$datos = $dao->consultaProveedor();
echo "<center><button type='button' class='btn btn-xs btn-default' id='btnver' onclick='eliminarProveedores()'><span class='glyphicon glyphicon-trash'></span></button></center>";
echo"<div class='table-responsive'><table cellpadding='0' cellspacing='0' border='0' class='table table-hover table-bordered' id='dtproveedor'><thead><th></th><th>Nombre</th><th>RFC</th><th>Dias de Credito</th><th>Email</th><th>Desct. Factura</th><th>Desct. Pronto Pago</th><th>Direccion</th></thead><tbody>";
while ($rs = mysql_fetch_array($datos)) {
    echo "<tr><td><input class='checkMarcas' type='checkbox' id='eliminar' onclick='eliminar()' value='$rs[idProveedor]'></td>";
    echo"<td>".utf8_encode($rs["nombre"])."</td>";
    echo"<td>$rs[rfc]</td>";
    echo"<td>$rs[diasCredito]</td>";
    echo"<td>$rs[email]</td>";
    echo"<td>$rs[descuentoPorFactura]</td>";
    echo"<td>$rs[descuentoPorProntoPago]</td>";
    echo"<td><center><button type='button' class='btn btn-xs btn-default' id='btnver' onclick='verDireccion($rs[idDireccion])'><span class='glyphicon glyphicon-map-marker'></span></button></center></td></tr>";
    
}
echo"</tbody></table></div>";
