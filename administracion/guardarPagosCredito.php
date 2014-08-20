<?php

session_start();
include './administracion.dao/dao.php';
$dao = new dao ();
$idsucursal = 0;
$idsucursal = $_SESSION["sucursalSesion"];
$usuario = $_SESSION["usuarioSesion"];
$folioOrdenVenta = 0;
$idXmlComprobante = 0;
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
        $mensaje = $dao->finalizarVenta($idXmlComprobante, $idsucursal, $idFolio, $usuario, $folioOrdenVenta);
        if ($mensaje == "") {
            $mensaje = "Exito Venta Concretada";
        }
    }
}
echo $mensaje;