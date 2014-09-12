<?php

session_start();
include './administracion.dao/dao.php';
include '../daoconexion/daoConeccion.php';
$bnd_es = $_GET["bnd_es"];
$bnd_tipoconsulta = $_GET["bnd_tipoconsulta"];
$fecha_inicial = $_GET["fecha_inicial"];
$fecha_final = $_GET["fecha_final"];
$txt_rfc = $_GET["txt_rfc"];
$txt_user = $_GET["txt_user"];
$suc = $_SESSION["sucursalSesion"];
if ($bnd_es == 1) {
    if ($bnd == 1) {
        $query = "SELECT * FROM xmlcomprobantes xcm "
                . "WHERE xcm.tipoComprobante = 'Ventas' AND xcm.statusOrden = '3' OR xcm.statusOrden = '9' AND idSucursal = '$suc'";
    }
    if ($bnd == 2) {
        $query = "SELECT * FROM xmlcomprobantes xcm "
                . "WHERE xcm.tipoComprobante = 'Ventas' AND xcm.statusOrden = '3' OR xcm.statusOrden = '9' idSucursal = '$suc'"
                . "AND xcm.fechaMovimiento BETWEEN '$fecha_inicial' AND '$fecha_final'";
    }
    if ($bnd == 3) {
        $query = "SELECT * FROM xmlcomprobantes xcm "
                . "WHERE xcm.tipoComprobante = 'Ventas' AND xcm.statusOrden = '3' OR xcm.statusOrden = '9' AND xcm.rfcComprobante = '$txt_rfc' idSucursal = '$suc'";
    }

    if ($bnd == 5) {
        $query = "SELECT * FROM xmlcomprobantes xcm "
                . "WHERE xcm.tipoComprobante = 'Ventas' AND xcm.statusOrden = '3' OR xcm.statusOrden = '9' AND xcm.rfcComprobante = '$txt_rfc' idSucursal = '$suc'"
                . "AND xcm.fechaMovimiento BETWEEN '$fecha1' AND '$fecha2'";
    }
}
if ($bnd_es == 2) {
    if ($bnd == 1) {
        $query = "SELECT * FROM xmlcomprobantes xcm "
                . "WHERE xcm.tipoComprobante = 'Ventas' AND xcm.statusOrden = '7' idSucursal = '$suc'";
    }
    if ($bnd == 2) {
        $query = "SELECT * FROM xmlcomprobantes xcm "
                . "WHERE xcm.tipoComprobante = 'Ventas' AND xcm.statusOrden = '7'"
                . "AND xcm.fechaMovimiento BETWEEN '$fecha_inicial' AND '$fecha_final' idSucursal = '$suc'";
    }
    if ($bnd == 3) {
        $query = "SELECT * FROM xmlcomprobantes xcm "
                . "WHERE xcm.tipoComprobante = 'Ventas' AND xcm.statusOrden = '7' AND xcm.rfcComprobante = '$txt_rfc' idSucursal = '$suc'";
    }
    if ($bnd == 4) {
        $query = "SELECT * FROM xmlcomprobantes xcm "
                . "INNER JOIN ventasusuario vu ON vu.idXmlComprobante = xcm.idXmlComprobante "
                . "WHERE xcm.tipoComprobante = 'Ventas' AND xcm.statusOrden = '7' AND vu.usuariousuario = '$txt_user' idSucursal = '$suc'";
    }
    if ($bnd == 5) {
        $query = "SELECT * FROM xmlcomprobantes xcm "
                . "WHERE xcm.tipoComprobante = 'Ventas' AND xcm.statusOrden = '7' AND xcm.rfcComprobante = '$txt_rfc' idSucursal = '$suc'"
                . "AND xcm.fechaMovimiento BETWEEN '$fecha1' AND '$fecha2'";
    }
    if ($bnd == 6) {
        $query = "SELECT * FROM xmlcomprobantes xcm "
                . "WHERE xcm.tipoComprobante = 'Ventas' AND xcm.statusOrden = '7' vu.usuariousuario = '$txt_user' idSucursal = '$suc'"
                . "AND xcm.fechaMovimiento BETWEEN '$fecha1' AND '$fecha2'";
    }
}