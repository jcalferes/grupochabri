<?php

include_once './administracion.dao/dao.php';
$dao = new dao();
session_start();
$suma = 0;
$sucursal = $_SESSION["sucursalSesion"];
$transferencia = $_GET["transferencia"];
$sucu = $_GET["sucu"];
$datos = $dao->mostrarDetallesTransferencias($sucursal, $transferencia);
echo"<center><input  type='button' id ='detalleTransferencia' class='btn btn-primary' data-dismiss='modal' data-toggle='modal' data-target='#mdlDetalleTransferencia' value='+' style='display: none;'/><button type='button' class='btn btn-xs btn-default' id='btnver' onclick='eliminarProductos()'><span class='glyphicon glyphicon-trash'></span></button></cente><div class='table-responsive'><table id='tdProducto'  class='table table-hover'><thead><th>codigoProducto</th><th>detalles</th><th>Cantidad a dar</th><th>Cantidad pedida</th><th>Costo</th><th>cantidad en Inventario</th><th>x</th></thead><tbody>";
while ($rs = \mysql_fetch_array($datos, MYSQL_ASSOC)) {
    $cantidad = $rs["cantidad"];
    $costo = $rs["costo"];
    $total = $cantidad * $costo;
    $suma = $suma + $total;
    echo"<tr><td><input type='text' class='myCodigo2 form-control' id='codigo2$rs[codigoProducto]' value='$rs[codigoProducto]' disabled/></td>";
    echo"<td ><input type='text' id='producto$rs[codigoProducto]' class='form-control' value='$rs[producto]' disabled/></td>";
    echo"<td ><div id='div2$rs[codigoProducto]'  class='form-group'><input type='text' id=txtCantidad2$rs[codigoProducto] class='form-control' value='$rs[cantidad]' onblur='sacarTotal2(\"$rs[codigoProducto]\")'></div></td>";
    echo"<td ><input type='text' id=txtCantidad3$rs[codigoProducto] value='$rs[cantidad]' class='form-control' disabled/></td>";
    echo"<td ><input type='text' id='costoUnitario2$rs[codigoProducto]' value='$rs[costo]' class='form-control' disabled/></td>";
    echo"<td><input type='text' id='txtMaxCantidad2$rs[codigoProducto]' value='$rs[cantidadTotal]' class='form-control' disabled/></td>";
    echo"<td ><input type='text' class='requisicion form-control' id='txtTotal2$rs[codigoProducto]' value='$total'  disabled/></td>";
}
echo"</tbody></table></div>";
echo "<div class='form-control'>Total:  <input type='text' id='costoTotal2' class ='form-control' value='$suma' disabled/><param id= 'sucu' value='$sucu'><param id= 'transf' value='$transferencia'></div>";
