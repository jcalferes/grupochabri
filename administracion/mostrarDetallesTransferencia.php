<?php

include_once './administracion.dao/dao.php';
$dao = new dao();
session_start();
$sucursal = $_SESSION["sucursalSesion"];
$transferencia = $_GET["transferencia"];
$sucu = $_GET["sucu"];
$datos = $dao->mostrarDetallesRequisicion($sucursal, $transferencia,$sucu);
echo"<center><input  type='button' id ='detalleTransferencia' class='btn btn-primary' data-dismiss='modal' data-toggle='modal' data-target='#mdlDetalleTransferencia' value='+' style='display: none;'/><button type='button' class='btn btn-xs btn-default' id='btnver' onclick='eliminarProductos()'><span class='glyphicon glyphicon-trash'></span></button></cente><div class='table-responsive'><table id='tdProducto'  class='table table-hover'><thead><th>codigoProducto</th><th>detalles</th><th>Cantidad</th><th>Costo</th></thead><tbody>";
while ($rs = \mysql_fetch_array($datos)) {
    echo"<tr><td >$rs[codigoProducto]</td>";
    echo"<td >$rs[producto]</td>";
    echo"<td >$rs[cantidad]</td>";
    echo"<td >$rs[cantidadTotal]</td>";
    echo"<td ></td>";
    echo"<td ></td>";
}
echo"</tbody></table></div>";

