<?php

include './administracion.dao/dao.php';
$dao = new dao();
$datos = $dao->consultaProveedor();
echo "<center><button type='button' class='btn btn-xs btn-default' id='btnver' onclick='eliminarProveedores()'><span class='glyphicon glyphicon-trash'></span></button></center>";
echo"<div class='table-responsive'><table class='table table-hover' id='dtproveedor'><thead><th></th><th>Nombre</th><th>RFC</th><th>Dias de Credito</th><th>Desct. Factura</th><th>Desct. Pronto Pago</th><th>Direccion</th></thead><tbody>";
while ($rs = mysql_fetch_array($datos)) {
    echo "<tr><td><center><input class='checkMarcas' type='checkbox' id='eliminar' value='$rs[idProveedor]'></center></td>";
    echo"<td>" . $rs["nombre"] . "</td>";
    echo"<td>$rs[rfc]</td>";
    echo"<td>$rs[diasCredito]</td>";
    echo"<td>$rs[descuentoPorFactura]</td>";
    echo"<td>$rs[descuentoPorProntoPago]</td>";
    echo"<td><center><button type='button' class='btn btn-xs' id='btnver' onclick='verDireccion($rs[idDireccion])'><span class='glyphicon glyphicon-map-marker'></span></button></center></td></tr>";
}
echo"</tbody></table></div>";
