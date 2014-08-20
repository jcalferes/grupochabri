<?php

session_start();
include_once '../daoconexion/daoConeccion.php';
include './administracion.dao/dao.php';

$cn = new coneccion();
$dao = new dao();

$cantidad = $_GET["cantidad"];
$idcliente = $_GET["idcliente"];
$foliocancelacion = $_GET["foliocancelacion"];
$sucursal = $_SESSION["sucursalSesion"];
$cn->Conectarse();

$ctrl = $dao->guardarNotasCredito($idcliente, $cantidad, $sucursal, $foliocancelacion);
if ($ctrl != true) {
    echo 1;
} else {
    echo 0;
}




