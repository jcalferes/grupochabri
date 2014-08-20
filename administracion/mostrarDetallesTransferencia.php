<?php

include_once './administracion.dao/dao.php';
$dao = new dao();
session_start();
$sucursal = $_SESSION["sucursalSesion"];
$aceptacion = $_GET["aceptacion"];
$transferir = $_GET["transferir"];
$transferencia = $_GET["transferencia"];
$sucu = $_GET["sucu"];
if ($aceptacion == '5') {
    $datos = $dao->mostrarDetallesTransferencias2($sucursal,$transferencia);
    echo"<center><input  type='button' id ='detalleTransferencia' class='btn btn-cprimary' data-dismiss='modal' data-toggle='modal' data-target='#mdlDetalleTransferencia' value='+' style='display: none;'/><button type='button' class='btn btn-xs btn-default' id='btnver' onclick='eliminarProductos()'><span class='glyphicon glyphicon-trash'></span></button></cente><div class='table-responsive'><table id='tdProductos'  class='table table-hover'><thead><th>codigoProducto</th><th>detalles</th><th>Cantidad</th><th>CantidadTotal</th><th>Costo</th></thead><tbody>";
    while ($rs = \mysql_fetch_array($datos)) {
        echo"<tr><td >$rs[codigoProducto]</td>";
        echo"<td >$rs[producto]</td>";
        echo"<td >$rs[cantidad]</td>";
        echo"<td >$rs[cantidadTotal]</td>";
        echo"<td >$rs[costo]</td>";
        echo"<td ></td>";
    }
    echo"</tbody></table></div>";
    if ($transferir == 5 && $aceptacion == 6) {
        echo"<input type='button' id='aceptarTraferencia' class ='btn btn-cprimary' onclick='aceptarTransferencia($transferencia)' value='Tranferencia Hecha'>";
    } else {
        
    }
} else {
    if($aceptacion == 4){
         $datos = $dao->mostrarDetallesTransferencias2($sucursal,$transferencia);
    echo"<center><input  type='button' id ='detalleTransferencia' class='btn btn-cprimary' data-dismiss='modal' data-toggle='modal' data-target='#mdlDetalleTransferencia' value='+' style='display: none;'/><button type='button' class='btn btn-xs btn-default' id='btnver' onclick='eliminarProductos()'><span class='glyphicon glyphicon-trash'></span></button></cente><div class='table-responsive'><table id='tdProductos'  class='table table-hover'><thead><th>codigoProducto</th><th>detalles</th><th>Cantidad Pedida</th><th>CantidadTotal</th><th>Costo</th></thead><tbody>";
    while ($rs = \mysql_fetch_array($datos)) {
        echo"<tr><td >$rs[codigoProducto]</td>";
        echo"<td >$rs[producto]</td>";
        echo"<td >$rs[cantidad]</td>";
        echo"<td >$rs[cantidadTotal]</td>";
        echo"<td >$rs[costo]</td>";
        echo"<td ></td>";
    }
    echo"</tbody></table></div>";
    if ($transferir == 5 && $aceptacion == 6) {
        echo"<input type='button' id='aceptarTraferencia' class ='btn btn-cprimary' onclick='aceptarTransferencia($transferencia)' value='Tranferencia Hecha'>";
    } else {
        
    }
    }else{
         $datos = $dao->mostrarDetallesTransferenciasAceptadas($sucursal, $transferencia);
    echo"<center><input  type='button' id ='detalleTransferencia' class='btn btn-cprimary' data-dismiss='modal' data-toggle='modal' data-target='#mdlDetalleTransferencia' value='+' style='display: none;'/><button type='button' class='btn btn-xs btn-default' id='btnver' onclick='eliminarProductos()'><span class='glyphicon glyphicon-trash'></span></button></cente><div class='table-responsive'><table id='tdProductos'  class='table table-hover'><thead><th>codigoProducto</th><th>detalles</th><th>Cantidad</th><th>CantidadTotal</th><th>Costo</th></thead><tbody>";
    while ($rs = \mysql_fetch_array($datos)) {
        echo"<tr><td >$rs[codigoProducto]</td>";
        echo"<td >$rs[producto]</td>";
        echo"<td >$rs[cantidad]</td>";
        echo"<td >$rs[cantidadTotal]</td>";
        echo"<td >$rs[costo]</td>";
        echo"<td ></td>";
    }
    echo"</tbody></table></div>";
    if ($transferir == 5 && $aceptacion == 6) {
        echo"<input type='button' id='aceptarTraferencia' class ='btn btn-cprimary' onclick='aceptarTransferencia($transferencia)' value='Tranferencia Hecha'>";
    } else {
        
    }
    }
   
}


