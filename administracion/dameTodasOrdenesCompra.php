<?php

include './administracion.dao/dao.php';
$dao = new dao();
session_start();
$idSucursal = 0;
$idSucursal = $_SESSION["sucursalSesion"];
$datos = $dao->obtenerOrdenesCompraTodas($idSucursal);
if ($datos == false) {
    echo mysql_error();
} else {
    echo '<table>';
    echo '<thead>'
    . '<th><center>Folio</center></th>'
    . '<th><center>Rfc</center></th>'
    . '<th><center>Tipo Pago</center></th>'
    . '</thead>';
    while ($rs = mysql_fetch_array($datos)) {
        $rfc = "";
        $rfc = $rs["rfcComprobante"];
        if ($rfc == 0) {
            $rfc = "Venta al público";
        }
        echo '<tr>'
        . '<td><center><a onclick=" cargarInformacion(' . $rs["folioComprobante"] . ', '.$rs["idTipoPago"].')">'
        . $rs["folioComprobante"] .
        '</a></center></td>'
        . '<td><center>' . $rfc . '</center></td>'
        . '<td><center>' . $rs["tipoPago"] . '</center></td>'
        . '<tr>';
    }
    echo '</table>';
}
