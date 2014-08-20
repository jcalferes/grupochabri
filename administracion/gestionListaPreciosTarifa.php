<?php

include_once './administracion.dao/dao.php';
$dao = new dao();
session_start();
$sucursal = $_SESSION["sucursalSesion"];

$codigoProducto = $_GET["codigoProducto"];

$datos = $dao->mostrarTarifasTabla($codigoProducto, $sucursal);

if ($datos !== 0) {
    $arreglo = array();
    while ($rs = \mysql_fetch_array($datos, MYSQL_ASSOC)) {

//    echo $cont++;
//    while ($rs = mysql_fetch_array($datos2, MYSQL_ASSOC)) {
//        if ($rs2["idListaPrecio"] == $rs["idListaPrecio"]) {
        $union = $codigoProducto . "_" . $rs["idListaPrecio"] . "_" . $rs["porcentaUtilidad"] . "_" . $rs["tarifa"] . "_" . $rs["nombreListaPrecio"];
        $arreglo[] = $union;
        $costo = $rs["costo"];
//        }
//    }
//    mysql_data_seek($datos2, 0);
    }
    echo"<div class='table-responsive'><table class='table table-hover'><thead><th>Nombre</th><th>% de Utilidad</th><th>% en pesos</th><th>Tarifa</th></thead><tbody>";

    foreach ($arreglo as $valor) {
        $pieces = explode("_", $valor);
        $neto = $costo * ($pieces[2] / 100);
        $total = $pieces[3];
        $validando1 = str_replace(" ", "_", $pieces[4]);
        echo"<tr><td><label>$validando1</label></td><td><input type='text' class='producto form-control' id='texto $validando1'    name='$validando1' onkeyup='obtenerUtilidad(\"$pieces[0]\")' onkeypress='return NumCheck(event, this)' value='$pieces[2]' disabled/></td>";
        echo"<td ><input type='text' class='producto form-control ' name='$validando1' id='tarifa$validando1' value='$neto ' disabled/></td>";
        echo"<td ><input type='text' class='producto form-control ' name='$validando1' id='tarifa$validando1' value='$total ' disabled/></td></tr>";
    }


    echo '</tbody></table></div>';
} else {
    echo"<div class='table-responsive'><table class='table table-hover'><thead><th>Nombre</th><th>% de Utilidad</th><th>Tarifa</th></thead><tbody>";
    echo '</tbody></table></div>';
    echo 'No hay tarifas para este producto';
}
