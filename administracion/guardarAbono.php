<?php

session_start();
include_once '../daoconexion/daoConeccion.php';
include './administracion.dao/dao.php';

$dao = new dao();
$cn = new coneccion();

$sucursal = 1;
$fecha = date("d-m-Y");
$folio = $_GET["folio"];
$monto = $_GET["monto"];
$tipopago = $_GET["tipopago"];
$referencia = $_GET["referencia"];
$observ = $_GET["observ"];
$liquida = $_GET["liquida"];

$cn->Conectarse();
$stat = $dao->guardarAbono($folio, $sucursal, $fecha, $monto, $tipopago, $referencia, $observ, $liquida);
$cn->cerrarBd();

if ($stat == true) {
    $rs = 0;
} else {
    $rs = 1;
}
echo $rs;
