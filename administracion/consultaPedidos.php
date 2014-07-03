<?php

include './administracion.dao/dao.php';
$dao = new dao();
session_start();
$sucursal = $_SESSION["sucursalSesion"];
$datos = $dao->consultaPedidosR($sucursal);
echo"<div class='table-responsive'><table id='tdconsped'  class='table table-hover'><thead><th>Numero de transferencia</th><th>Estatus de aprobacion</th><th>Estatus de transferencia</th><th>Fecha</th><th>Pedido de sucursal</th></thead><tbody>";
while ($rs = \mysql_fetch_array($datos)) {
    echo"<tr><td >$rs[idEncabezadoRequisicion]</td>";
    echo"<td >$rs[plop]</td>";
    echo"<td >$rs[prr]</td>";
    echo"<td >$rs[fechaRequisicion]</td>";
    echo"<td >$rs[sucursal]</td>";
    echo"<td ><button type='button' class='btn btn-xs' value='Detalles' onclick='condicionesPeticion($rs[idEncabezadoRequisicion],$rs[idSucursal],$rs[idStatus],$rs[statusAprobacion])'><span class='glyphicon glyphicon-info-sign'></span></button></td></tr>";
}
echo"</tbody></table></div>";
