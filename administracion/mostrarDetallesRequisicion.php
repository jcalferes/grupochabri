<?php

include_once './administracion.dao/dao.php';
$dao = new dao();
session_start();
$suma = 0;
$sucursal = $_SESSION["sucursalSesion"];
$transferencia = $_GET["transferencia"];
$aceptacion = $_GET["aceptacion"];
$sucu = $_GET["sucu"];
if($aceptacion == "5"){
    
    $datos = $dao->mostrarDetallesTransferencias($sucursal, $transferencia);
echo"<div class='table-responsive'><table id='tdProductos'  class='table table-hover'><thead><th>codigoProducto</th><th>detalles</th><th>Cantidad aceptada</th><th>Cantidad pedida</th><th>Costo</th><th>cantidad en Inventario</th><th>Costo Total</th></thead><tbody>";
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
echo "<div class='form-inline'><label>Total:</label><input type='text' id='costoTotal2' class='form-control' value='$suma' style='width: 75px' disabled/><param id='sucu' value='$sucu'><param id='transf' value='$transferencia'></div>";

    
}else{
    if($aceptacion == 4){
         $datos = $dao->mostrarDetallesTransferencias($sucursal, $transferencia);
echo"<div class='table-responsive'><table id='tdProductos'  class='table table-hover'><thead><th>codigoProducto</th><th>detalles</th><th>Cantidad pedida</th><th>Costo</th><th>cantidad en Inventario</th><th>Costo Total</th></thead><tbody>";
while ($rs = \mysql_fetch_array($datos, MYSQL_ASSOC)) {
    $cantidad = $rs["cantidad"];
    $costo = $rs["costo"];
    $total = $cantidad * $costo;
    $suma = $suma + $total;
    echo"<tr><td><input type='text' class='myCodigo2 form-control' id='codigo2$rs[codigoProducto]' value='$rs[codigoProducto]' disabled/></td>";
    echo"<td ><input type='text' id='producto$rs[codigoProducto]' class='form-control' value='$rs[producto]' disabled/></td>";
//    echo"<td ><div id='div2$rs[codigoProducto]'  class='form-group'><input type='text' id=txtCantidad2$rs[codigoProducto] class='form-control' value='$rs[cantidad]' onblur='sacarTotal2(\"$rs[codigoProducto]\")'disabled></div></td>";
    echo"<td ><input type='text' id=txtCantidad3$rs[codigoProducto] value='$rs[cantidad]' class='form-control' disabled/></td>";
    echo"<td ><input type='text' id='costoUnitario2$rs[codigoProducto]' value='$rs[costo]' class='form-control' disabled/></td>";
    echo"<td><input type='text' id='txtMaxCantidad2$rs[codigoProducto]' value='$rs[cantidadTotal]' class='form-control' disabled/></td>";
    echo"<td ><input type='text' class='requisicion form-control' id='txtTotal2$rs[codigoProducto]' value='$total'  disabled/></td>";
}
echo"</tbody></table></div>";
echo "<div class='form-control'>Total:  <input type='text' id='costoTotal2' class ='form-control' value='$suma' disabled/><param id= 'sucu' value='$sucu'><param id= 'transf' value='$transferencia'></div>";

    } else{
            $datos = $dao->mostrarDetallesTransferenciasAceptadas($sucursal, $transferencia);
echo"<div class='table-responsive'><table id='tdProductos'  class='table table-hover'><thead><th>codigoProducto</th><th>detalles</th><th>Cantidad aceptada</th><th>Costo</th><th>cantidad en Inventario</th><th>Costo Total</th></thead><tbody>";
while ($rs = \mysql_fetch_array($datos, MYSQL_ASSOC)) {
    $cantidad = $rs["cantidad"];
    $costo = $rs["costo"];
    $total = $cantidad * $costo;
    $suma = $suma + $total;
    echo"<tr><td><input type='text' class='myCodigo2 form-control' id='codigo2$rs[codigoProducto]' value='$rs[codigoProducto]' disabled/></td>";
    echo"<td ><input type='text' id='producto$rs[codigoProducto]' class='form-control' value='$rs[producto]' disabled/></td>";
    echo"<td ><div id='div2$rs[codigoProducto]'  class='form-group'><input type='text' id=txtCantidad2$rs[codigoProducto] class='form-control' value='$rs[cantidad]' onblur='sacarTotal2(\"$rs[codigoProducto]\")' disabled></div></td>";
//    echo"<td ><input type='text' id=txtCantidad3$rs[codigoProducto] value='$rs[cantidad]' class='form-control' disabled/></td>";
    echo"<td ><input type='text' id='costoUnitario2$rs[codigoProducto]' value='$rs[costo]' class='form-control' disabled/></td>";
    echo"<td><input type='text' id='txtMaxCantidad2$rs[codigoProducto]' value='$rs[cantidadTotal]' class='form-control' disabled/></td>";
    echo"<td ><input type='text' class='requisicion form-control' id='txtTotal2$rs[codigoProducto]' value='$total'  disabled/></td>";
}
echo"</tbody></table></div>";
echo "<div class='form-control'>Total:  <input type='text' id='costoTotal2' class ='form-control' value='$suma' disabled/><param id= 'sucu' value='$sucu'><param id= 'transf' value='$transferencia'></div>";
 
    }

    
}
   