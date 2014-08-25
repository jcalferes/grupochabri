<?php
session_start();
include './administracion.clases/CajaInicial.php';
include './administracion.dao/dao.php';
$idSucursal = $_SESSION["sucursalSesion"];
$cuadroCaja = $_GET["cuadro"];
$dao = new dao();
$caja = new CajaInicial();
$caja->setCajaCerrada("1");
$caja->setCuadroCaja($_GET["cuadro"]);
$caja->setCantidadCaja($_GET["cantidadCaja"]);
$caja->setCantidadSistema($_GET["cantidadSistema"]);
$caja->setObservaciones($_GET["observaciones"]);
$datos = $dao->finalizarDia($caja, $idSucursal);
if ($datos == false) {
    echo "<strong>ERROR!!!!</strong>" . mysql_error();
} else {
    echo 'Caja Finalizada';
}