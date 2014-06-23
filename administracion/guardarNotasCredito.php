<?php

session_start();
include_once '../daoconexion/daoConeccion.php';
include './administracion.dao/dao.php';

$cn = new coneccion();
$dao = new dao();

$cantidad = $_GET["cantidad"];
$idcliente = $_GET["idcliente"];
$sucursal = $_SESSION["sucursalSesion"];
$cn->Conectarse();

$valida = $dao->revisarExistenciaNotaCredito($idcliente, $sucursal);
if ($valida == 0) {
    $ctrl1 = $dao->guardarNotasCredito($idcliente, $cantidad, $sucursal);
    if ($ctrl1 != true) {
        echo '1';
    } else {
        echo '0';
    }
} else {
    $ctrl2; 
}




