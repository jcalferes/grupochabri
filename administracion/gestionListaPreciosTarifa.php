<?php

include_once './administracion.dao/dao.php';
$dao = new dao();
$codigoProducto = $_GET["codigoProducto"];

$datos = $dao->mostrarTarifasTabla($codigoProducto);
$datos2 = $dao->consultaListaPrecio();
echo ' <div class="form-group" >';

while ($rs = mysql_fetch_array($datos2)) {
    echo" <label>$rs[nombreListaPrecio]</label><input class='form-control tarifa' type='text' name='$rs[nombreListaPrecio]' id='$rs[nombreListaPrecio]'";
    while ($rs2 = mysql_fetch_array($datos)) {
        if ($rs2["idListaPrecio"] == $rs["idListaPrecio"]) {
            echo"value='$rs2[tarifa]'";
        }
       
    }
     echo 'disabled /></br>';
    mysql_data_seek($datos, 0);
}
echo '</div>';