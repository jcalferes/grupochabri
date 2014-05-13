<?php

include './administracion.dao/dao.php';
$dao = new dao();
$folio = $_GET["folio"];
$datos = $dao->consultarAbonos($folio);
if ($datos == 1) {
    echo"<div class='table-responsive' ><table class='table table-hover' id='dtabonos'><thead><th></th></thead><tbody>";
    echo"<td><h4>NO HAY ABONOS</h4></td></tr>";
//    while ($rs = mysql_fetch_array($datos)) {
//        echo"<td><h4>NO HAY ABONOS</h4></td></tr>";
//    }
    echo"</tbody></table></div>";
} else {
    echo"<div class='table-responsive' ><table class='table table-hover' id='dtabonos'><thead><th></th></thead><tbody>";
    echo"<td><h4>SI HAY ABONOS</h4></td></tr>";
//    while ($rs = mysql_fetch_array($datos)) {
//        echo"<td><h4>SI HAY ABONOS</h4></td></tr>";
//    }
    echo"</tbody></table></div>";
}




