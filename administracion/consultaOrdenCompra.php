<?php

include_once './administracion.dao/dao.php';
session_start();
$dao = new dao();
$folio = $_GET["folio"];
$comprobante = $_GET["comprobante"];
$idsucursal= $_SESSION["sucursalSesion"];
$datos = $dao->obtenerOrdenCompra($folio, $comprobante,$idsucursal);
$validar = mysql_affected_rows();
if ($validar > 0) {

    while ($datosOrden = mysql_fetch_array($datos)) {
        $arr[][] = array('subtotalComprobante' => $datosOrden["subtotalComprobante"], 'sdaComprobante' => $datosOrden["sdaComprobante"], 'rfcComprobante' => $datosOrden["rfcComprobante"], 'desctFacturaComprobante' => $datosOrden["desctFacturaComprobante"], 'desctProntoPagoComprobante' => $datosOrden["desctProntoPagoComprobante"], 'desctTotalComprobante' => $datosOrden["desctTotalComprobante"], 'desctGeneralComprobante' => $datosOrden["desctGeneralComprobante"], 'ivaComprobante' => $datosOrden["ivaComprobante"], 'totalComprobante' => $datosOrden["totalComprobante"], 'folioComprobante' => $datosOrden["folioComprobante"], 'tipoComprobante' => $datosOrden["tipoComprobante"], 'cantidadConcepto' => $datosOrden["cantidadConcepto"], 'descripcionConcepto' => $datosOrden["descripcionConcepto"], 'precioUnitarioConcepto' => $datosOrden["precioUnitarioConcepto"], 'cdaConcepto' => $datosOrden["cdaConcepto"], 'desctUnoConcepto' => $datosOrden["desctUnoConcepto"], 'desctDosConcepto' => $datosOrden["desctDosConcepto"], 'importeConcepto' => $datosOrden["importeConcepto"],'costoCotizacion' => $datosOrden["costoCotizacion"],'codigoConcepto' => $datosOrden["codigoConcepto"],'desctPorProductosComprobante' => $datosOrden["desctPorProductosComprobante"],'rfcComprobante' => $datosOrden["rfcComprobante"]);
    }

    echo json_encode($arr);
} else {
    echo '0';
}