<?php

session_start();
include_once './administracion.dao/dao.php';
$dao = new dao();
$rfc = $_GET["rfc"];
$idSucursal = $_SESSION["sucursalSesion"];
$rs = $dao->dameNotaCredito($idSucursal, $rfc);
if ($rs == false) {
    echo mysql_error();
} else {
    $x = false;
    while ($datos = mysql_fetch_array($rs)) {
        $x = true;
        echo '<div id = "creditoCliente">';
        echo '<strong>Nota de Credito : <span id="credito"> ' . $datos[0] . " mxn</span>";
        echo '<br/>';
    }
    if ($x == false) {
        echo '<div id = "creditoCliente">';
        echo '<strong>Nota de Credito : <span id="credito">0</span> mxn';
        echo '<br/>';
    }
}
