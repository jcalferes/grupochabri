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
    while ($rs = mysql_fetch_array($datos)) {
        echo '<table>';
        echo '';
        echo '</table>';
    }
}
