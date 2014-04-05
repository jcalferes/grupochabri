<?php

session_start();
include './administracion.dao/dao.php';
include_once '../daoconexion/daoConeccion.php';
$dao = new dao();
$cn = new coneccion();
if (isset($_SESSION["sucursalSesion"])) {
    $idsucursal = $_SESSION["sucursalSesion"];
    $cn->Conectarse();
    $rs = $dao->dondeInicie($idsucursal);
    while ($datos = mysql_fetch_array($rs)) {
        $sucursal = $datos["sucursal"];
    }
    echo $sucursal;
    $cn->cerrarBd();
} else {
    echo 999;
}





