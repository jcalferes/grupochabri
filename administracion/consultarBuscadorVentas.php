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
//$sucursales = $dao->consultaSucursales($idsucursal);

if ($datos ==true) {
    echo"<div class='table-responsive'>"
    . "<table id='tdProducto'  class='table table-hover'><thead><th></th><th>Producto</th><th>Codigo</th><th>Marca</th><th>Existencia</th><th>Existencia Proceso</th><th>Existencia Real</th>";
//    while($rss = mysql_fetch_array($sucursales)){
//        echo"<th> $rss[sucursal]</th>";
//    }
     echo"<tbody>";
    while ($rs = mysql_fetch_assoc($datos)) {
        $existenciaTemporal = 0;
        $existenciaDisponible = 0;
        $existenciaFisica = $rs["existencia"];
        $rsDatosTemporales = $dao->dameExistenciaTemporal($rs["codigoProducto"], $idsucursal);
        if ($rsDatosTemporales == false) {
            echo mysql_error();
            break;
        } else {
            while ($rs2 = mysql_fetch_array($rsDatosTemporales)) {
                $existenciaTemporal = $rs2["cantidad"];
            }
        }
        if ($existenciaTemporal == null) {
            $existenciaTemporal = 0;
        }
        echo"<tr><td><center><input type='checkbox' id='eliminar' value='$rs[codigoProducto]'><input  type='button' id ='detalleTarifa' class='btn btn-cprimary' data-dismiss='modal' data-toggle='modal' data-target='#mdlDetalleTarifa' value='+' style='display: none;'/></center></td> ";
        echo"<td>$rs[codigoProducto]</td>";
        echo"<td >$rs[producto]</td>";
        echo"<td id='$rs[marca]' >$rs[marca] </td>";
//        echo"<td id='$rs[proveedor]' >$rs[proveedor] </td>";
//        echo"<td id='$rs[grupoProducto]' >$rs[grupoProducto] </td>";
        echo"<td id='x' >$rs[existencia] </td>";
        echo "<td><center> $existenciaTemporal </center></td>";
        echo "<td><center> " . ($existenciaFisica - $existenciaTemporal) . "</center></td>";
        $codigosProd = $rs["codigoProducto"];
        $sucursales = $dao->consultaExistenciasgral($codigosProd,$idsucursal);
//         while ($rs3 = mysql_fetch_assoc($sucursales)) {
//        echo"<td>$rs3[cantidad]</td>";
//       
//         }
//        echo"<td id='x' >$rs[menudeo] </td>";
    }
    echo"</tbody></table></div>";
} else {
    echo mysql_error();
//    echo"<center><button type='button' class='btn btn-xs btn-default' id='btnver' onclick='eliminarProductos()'><span class='glyphicon glyphicon-trash'></span></button></cente><div class='table-responsive'><table id='tdProducto'  class='table table-hover'><thead><th></th><th>Producto</th><th>Codigo</th><th>Marca</th><th>Costo</th><th>Fecha Mov.</th><th>Existencia</th><th>List. Precios</th></thead><tbody>";
//    echo"</tbody></table></div>";
}