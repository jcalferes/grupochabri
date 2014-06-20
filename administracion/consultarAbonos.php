<?php

include './administracion.dao/dao.php';
$dao = new dao();
$folio = $_GET["folio"];
$datos = $dao->consultarAbonos($folio);
if ($datos == 1) {
    echo"<div class='table-responsive' ><table class='table table-hover' id='dtabonos'><thead><th></th></thead><tbody>";
    echo"<tr><td><h4>NO HAY ABONOS</h4></td></tr>";
//    while ($rs = mysql_fetch_array($datos)) {
//        echo"<td><h4>NO HAY ABONOS</h4></td></tr>";
//    }
    echo"</tbody></table></div>";
} else {
    echo"<div class='table-responsive' ><table class='table table-hover' id='dtabonos'><thead><th>Importe</th><th>Referencia</th><th>Tipo de Pago</th><th>Fecha de pago</th></thead><tbody>";
    while ($rs = mysql_fetch_array($datos)) {
        if ($rs['importe'] != 0) {
            echo"<tr><td><input type='number' class='importeabonos form-control' value='$rs[importe]' disabled/></td>";
            echo"<td>$rs[referencia]</td>";
            echo"<td>$rs[tipoPago]</td>";
            echo"<td>$rs[fechaAbono]</td></tr>";
        }
    }
    echo"</tbody></table></div>";
}



