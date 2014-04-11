<?php

include './administracion.dao/dao.php';
$dao = new dao();
session_start();
$sucursal = $_SESSION["sucursalSesion"];
$datos = $dao->consultaRequisicion($sucursal);
echo"<center><input  type='button' id ='detalleTransferencia' class='btn btn-primary' data-dismiss='modal' data-toggle='modal' data-target='#mdlDetalleTransferencia' value='+' style='display: none;'/><button type='button' class='btn btn-xs btn-default' id='btnver' onclick='eliminarProductos()'><span class='glyphicon glyphicon-trash'></span></button></cente><div class='table-responsive'><table id='tdProducto'  class='table table-hover'><thead><th>NumeroTransferencia</th><th>EstatusAprobacion</th><th>EstatusTransferencia</th><th>fecha</th><th>pedido a sucursal.</th></thead><tbody>";
while ($rs = mysql_fetch_array($datos)) {
    echo"<tr><td >$rs[idEncabezadoRequisicion]</td>";
    echo"<td >$rs[plop]</td>";
    echo"<td >$rs[prr]</td>";
    echo"<td >$rs[fechaRequisicion]</td>";
    echo"<td >$rs[sucursal]</td>";
    echo"<td ><button type='button' class='btn btn-xs' value='Detalles' onclick='detallesTransferencia($rs[idEncabezadoRequisicion],$rs[idSucursal],$rs[idStatusTransf],$rs[idStatusAceptacion])'><span class='glyphicon glyphicon-info-sign'></span></button></td></tr>";
}
echo"</tbody></table></div>";