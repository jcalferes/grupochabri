<?php

session_start();
include './administracion.dao/dao.php';
if (isset($_GET["sucursal"])) {
    $idsucursal = $_GET["sucursal"];
} else {
    $idsucursal = $_SESSION["sucursalSesion"];
}
$dao = new dao();
$datos = $dao->consultaBuscador($idsucursal);
if ($datos > 0) {
    echo"<div class='table-responsive'><table id='tdProducto'  class='table table-hover table-condensed'><thead><th></th><th>Producto</th><th>Codigo</th><th>Marca</th><th>Grupo</th><th>Existencia</th><th>Precio</th></thead><tbody>";
    while ($rs = mysql_fetch_assoc($datos)) {
        echo"<tr><td><center><input type='checkbox' id='eliminar' value='$rs[codigoProducto]'><input  type='button' id ='detalleTarifa' class='btn btn-cprimary' data-dismiss='modal' data-toggle='modal' data-target='#mdlDetalleTarifa' value='+' style='display: none;'/></center></td> ";
        echo"<td>$rs[codigoProducto]</td>";
        echo"<td >" . ucwords(strtolower($rs["producto"])) . "</td>";
        echo"<td id='$rs[marca]' >" . ucwords(strtolower($rs["marca"])) . "</td>";
        echo"<td id='$rs[grupoProducto]' >" . ucwords(strtolower($rs["grupoProducto"])) . "</td>";
        echo"<td id='x' >$rs[existencia] </td>";
        $costo = $rs["menudeo"];
        $iva = ($costo * 16) / 100;
        $costoiva = $costo + $iva;
        echo"<td id='x' >$" . $costoiva . "</td>";
    }
    echo"</tbody></table></div>";
} else {
    echo"<center><button type='button' class='btn btn-xs btn-default' id='btnver' onclick='eliminarProductos()'><span class='glyphicon glyphicon-trash'></span></button></cente><div class='table-responsive'><table id='tdProducto'  class='table table-hover'><thead><th></th><th>Producto</th><th>Codigo</th><th>Marca</th><th>Costo</th><th>Fecha Mov.</th><th>Existencia</th><th>List. Precios</th></thead><tbody>";
    echo"</tbody></table></div>";
}

