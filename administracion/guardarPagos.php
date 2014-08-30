<?php

session_start();
include './administracion.dao/dao.php';
$dao = new dao ();
$idsucursal = 0;
$idTipoPago = 0;
$idsucursal = $_SESSION["sucursalSesion"];
$usuario = $_SESSION["usuarioSesion"];
$idTipoPago = $_GET["idTipoPago"];
$importe = $_GET["importe"];
$folioOrdenVenta = 0;
$idXmlComprobante = 0;
$tipoPagoCredito = $_GET["formaPago"];
$saldoCredito = $_GET["totalCredito"];
//$idXmlComprobante = $_GET["folioComprobante"];
$idFolio = 0;
$mensaje = "";
$rs = $dao->dameFolio($idsucursal);
$dato = $dao->dameFolioOrdenCompra($idsucursal);
if ($dato == false) {
    $mensaje = mysql_error();
} else {
    while ($r = mysql_fetch_array($dato)) {
        $folioOrdenVenta = $r[0];
    }
    if ($rs == false) {
        $mensaje = mysql_error();
    } else {
        while ($dat = mysql_fetch_array($rs)) {
            $idFolio = $dat[0];
        }
        $idXmlComprobante = $_GET["folioComprobante"];
        $rsFolioComprobante = $dao->dameFolioComprobante($idXmlComprobante);
        if ($rsFolioComprobante == false) {
            $mensaje = mysql_error();
        } else {
            $folioComprobante = 0;
            while ($rsFolio = mysql_fetch_array($rsFolioComprobante)) {
                $folioComprobante = $rsFolio["folioComprobante"];
            }
            $mensaje = $dao->finalizarVenta($idXmlComprobante, $idsucursal, $idFolio, $usuario, $folioOrdenVenta, $idTipoPago, $importe, $folioComprobante, $tipoPagoCredito, $saldoCredito);
            if ($mensaje == "") {
                $mensaje = $idFolio;
            }
            
        }
    }
}
echo $mensaje;

