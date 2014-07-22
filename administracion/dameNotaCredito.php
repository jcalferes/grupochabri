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
    while ($datos = mysql_fetch_array($rs)) {
        echo '<div id = "creditoCliente">';
        echo '<strong>Nota de Credito : <span id="credito"> ' . $datos[0] . "</span>";
        echo '<br/>';
        
    }
}
