<?php

session_start();
include './administracion.dao/dao.php';
$dao = new dao();
$sucursal = "";
$sucursal = $_SESSION["sucursalSesion"];
$tipo = $_SESSION["tipoSesion"];
$datos = $dao->consultaProducto($sucursal);
$comprobar = "";
if ($datos > 0) {
    echo"<div class='table-responsive'><table id='tdProducto'  class='table table-hover'><thead><th></th><th>Producto</th><th>Codigo</th><th>Barras</th><th>Marca</th><th>Costo</th><th>Fecha Mov.</th><th>Existencia</th><th>List. Precios</th></thead><tbody>";
    while ($rs = mysql_fetch_assoc($datos)) {
        $comillas = str_replace("\"", "\\\"", $rs['producto']);
        echo"<tr><td><center><input type='checkbox' id='eliminar' value='$rs[codigoProducto]'><input  type='button' id ='detalleTarifa' class='btn btn-cprimary' data-dismiss='modal' data-toggle='modal' data-target='#mdlDetalleTarifa' value='+' style='display: none;'/></center></td> ";
        echo"<td >" . utf8_encode($rs['producto']) . "</td>";
        $comprobar = $rs['codigoProducto'];
        echo"<td>$rs[codigoProducto]</td>";
        echo"<td>$rs[codigoBarrasProducto]</td>";
        echo"<td id='$rs[marca]' >$rs[marca] </td>";
        echo"<td id='$rs[costo]' style='text-align: right'> $" . number_format($rs['costo'], 2) . "</td>";
        echo"<td id='$rs[fechaMovimiento]' >$rs[fechaMovimiento] </td>";
        echo"<td id='$rs[cantidad]'  style='text-align: right' >$rs[cantidad] </td>";
        echo "<td><center><button type='button' class='btn btn-xs' value='Detalles' onclick='gestionTarifas(" . "\"$rs[codigoProducto]\"" . "," . "\"$comillas\"" . "," . "\"$rs[costo]\"" . ")' ><span class='glyphicon glyphicon-info-sign'></span></button></center></td></tr>";
    }
    echo"</tbody></table></div>";
} else {
    echo"<center><button type='button' class='btn btn-xs btn-default' id='btnver' onclick='eliminarProductos()'><span class='glyphicon glyphicon-trash'></span></button></cente><div class='table-responsive'><table id='tdProducto'  class='table table-hover'><thead><th></th><th>Producto</th><th>Codigo</th><th>Marca</th><th>Costo</th><th>Fecha Mov.</th><th>Existencia</th><th>List. Precios</th></thead><tbody>";
    echo"</tbody></table></div>";
}

