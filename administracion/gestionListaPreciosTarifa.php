<?php

include_once './administracion.dao/dao.php';
$dao = new dao();
$codigoProducto = $_GET["codigoProducto"];

$datos = $dao->mostrarTarifasTabla($codigoProducto);
$datos2 = $dao->consultaListaPrecio();

$arreglo = array();
while ($rs = mysql_fetch_array($datos2)) {
    while ($rs2 = mysql_fetch_array($datos)) {
        if ($rs2["idListaPrecio"] == $rs["idListaPrecio"]) {
            $union = $codigoProducto . "_" .$rs2["idListaPrecio"] . "_" . $rs2["porcentaUtilidad"] . "_" . $rs2["tarifa"]. "_" . $rs["nombreListaPrecio"];
            $arreglo[] = $union;
        }
    }
    
    mysql_data_seek($datos, 0);
}
echo"<div class='table-responsive'><table class='table table-hover'><thead><th>Nombre</th><th>% de Utilidad</th><th></th><th>Tarifa</th></thead><tbody>";

foreach ($arreglo as $valor){
    $pieces = explode("_", $valor);
    $validando1 = str_replace(" ", "_", $pieces[4]);
    echo"<tr><label>$validando1</label><td><input type='text' class='producto form-control' id='texto $validando1'    name='$validando1' onkeyup='obtenerUtilidad(\"$pieces[0]\")' onkeypress='return NumCheck(event, this)' disabled/></td>";
    echo"<td ><input type='text' class='producto form-control ' name='$validando1' id='tarifa$validando1' disabled/></td></tr>";
    }

echo '</tbody></table></div>';
