<?php

include_once './administracion.dao/dao.php';
$dao = new dao();
$codigoProducto = $_GET["codigoProducto"];

$datos = $dao->mostrarTarifasTabla($codigoProducto);
$datos2 = $dao->consultaListaPrecio();
echo ' <div class="form-group" >';

while ($rs = mysql_fetch_array($datos2)) {
    while ($rs2 = mysql_fetch_array($datos)) {
        if ($rs2["idListaPrecio"] == $rs["idListaPrecio"]) {
            $union = $rs2["idListaPrecio"]+ "_" + $rs2["porcentaUtilidad"] + "_" + $rs2["tarifa"];
            echo $union;
        }
       
    }
     
    mysql_data_seek($datos, 0);
}
echo '</div>';