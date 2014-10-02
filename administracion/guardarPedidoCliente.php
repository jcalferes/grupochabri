<?php

include_once './administracion.clases/Concepto.php';
include_once './administracion.clases/Comprobante.php';
include_once './administracion.dao/dao.php';
include_once '../utileriasPhp/Utilerias.php';
include_once '../daoconexion/daoConeccion.php';
include_once './administracion.clases/Encabezado.php';
include_once './administracion.clases/Detalle.php';
error_reporting(0);

session_start();
$dao = new dao();
$idCliente = $_SESSION["usuarioSesion"];
$tipo = "PEDIDO CLIENTE";
$idCliente = $dao->obtenerDatosCliente($idCliente);
while ($rs = mysql_fetch_array($idCliente)) {
    $rfcCliente = $rs["rfc"];
    $nombrecliente = $rs["nombre"];
}
//$idsucursal = $_SESSION["sucursalSesion"];
$idsucursal = $_POST["sucursal"];
$utilerias = new Utilerias();
$datos = json_decode(stripslashes($_POST['data']));
$band = $_POST["band"];
$folio = $_POST["folio"];
if ($band == "modifica") {
    $dao->modificaPedido($folio);
}
//$datosM = json_decode('data');
$comprobantes = $datos[0];
$conceptos = $datos[1];
$concepto = new Concepto();
$comprobante = new Comprobante();
$cn = new coneccion();

$encabezado = new Encabezado();
$comprobante->setConIva(floatval($comprobantes->ivaComprobante));
$comprobante->setDescuentoFactura($comprobantes->desctGeneralFactura);
$comprobante->setDescuentoGeneral($comprobantes->descuentosGenerales);
$comprobante->setDescuentoPorProducto($comprobantes->descuentoPorProductoComprobantes);
$comprobante->setDescuentoProntoPago(0);
$comprobante->setDescuentoTotal($comprobantes->descuentoTotalComprobante);
$comprobante->setFecha($comprobantes->fechaComprobante);
$comprobante->setFechaMovimiento();
$comprobante->setFolio($comprobantes->folioComprobante);
$comprobante->setRfc($rfcCliente);
$comprobante->setSda($comprobantes->sdaComprobante);
$comprobante->setSubtotal($comprobantes->subTotalComprobante);
$comprobante->setTotal($comprobantes->totalComprobante);
////----------------------------------------------------------
$encabezado->setFecha($comprobantes->fechaComprobante);
$encabezado->setFolio($comprobantes->folioComprobante);
$encabezado->setRfc($rfcCliente);
$encabezado->setSubtotal($comprobantes->subTotalComprobante);
$encabezado->setTotal($comprobantes->totalComprobante);

////----------------------------------------------------------
$contador = 0;
foreach ($conceptos as $detalles) {
    $detalle = new Detalle();
    $detalle->setCantidad($detalles->cantidadConcepto);
    $detalle->setCodigo($detalles->codigoConcepto);
    $detalle->setCosto($detalles->precioUnitarioConcepto);
    $detalle->setDescripcion($detalles->descripcionConcepto);
    $detalle->setIdFacturaEncabezado(0);
    $detalle->setImporte($detalles->importeConcepto);
    $detalle->setCostoCotizacion($detalles->costoCotizacion);
//    $detalle->setCostoCotizacion("hola");
//    $detalle->setUnidadmedida();

    $array[$contador] = $detalle;
    $contador ++;
}
$control = count($conceptos);
$cn->Conectarse();
$paso = $dao->superMegaGuardadorOrdenes($utilerias->generarFecha(), $encabezado, $array, $comprobante, $conceptos, $control, $idsucursal, $tipo, $nombrecliente);
echo $paso;
