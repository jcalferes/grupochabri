<?php

include './administracion.dao/dao.php';
$dao = new dao();
$datos = $dao->consultaCliente();
echo"<div class='table-responsive'><table class='table table-hover' id='dtcliente'><thead><th>Nombre</th><th>RFC</th><th>Credito</th><th>Dias de Credito</th><th>Desct. Factura</th><th>Desct. Pronto Pago</th><th>Direccion</th></thead><tbody>";
while ($rs = mysql_fetch_array($datos)) {
    echo "<tr>";
    echo"<td>" . utf8_encode($rs["nombre"]) . "</td>";
    echo"<td>$rs[rfc]</td>";
    echo"<td style='text-align:right'>$".number_format($rs['credito'],2)."</td>";
    echo"<td>$rs[diasCredito]</td>";
    echo"<td>$rs[descuentoPorFactura]</td>";
    echo"<td>$rs[descuentoPorProntoPago]</td>";
    echo"<td><center><button type='button' class='btn btn-xs' id='btnver' onclick='verDireccion($rs[idDireccion],\"$rs[rfc]\")'><span class='glyphicon glyphicon-map-marker'></span></button></center></td></tr>";
}
echo"</tbody></table></div>";
