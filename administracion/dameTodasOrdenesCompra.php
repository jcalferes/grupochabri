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
    . '<th><center>Cliente</center></th>'
    . '<th><center>Tipo Pago</center></th>'
    . '</thead>';
    while ($rs = mysql_fetch_array($datos)) {
        $nombreCliente = "";
        $nombreCliente = $rs["nombreCliente"];
        echo '<tr>'
        . '<td><center><a onclick=" cargarInformacion(' . $rs["folioComprobante"] . ', '.$rs["idTipoPago"].')">'
        . $rs["folioComprobante"] .
        '</a></center></td>'
        . '<td><center>' . $nombreCliente . '</center></td>'
        . '<td><center>' . $rs["tipoPago"] . '</center></td>'
        . '<tr>';
    }
    echo '</table>';
}
