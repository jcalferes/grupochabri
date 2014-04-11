<?php

include './administracion.clases/Concepto.php';
include './administracion.clases/Comprobante.php';
include './administracion.dao/dao.php';
include '../utileriasPhp/Utilerias.php';
include '../daoconexion/daoConeccion.php';
include './administracion.clases/Encabezado.php';
include './administracion.clases/Detalle.php';
session_start();
$usuario = $_SESSION["usuarioSesion"];
$idsucursal = $_SESSION["sucursalSesion"];
$utilerias = new Utilerias();
$datos = json_decode(stripslashes($_POST['data']));
//$datosM = json_decode('data');
$comprobantes = $datos[0];
$conceptos = $datos[1];
$concepto = new Concepto();
$comprobante = new Comprobante();
$cn = new coneccion();
$dao = new dao();
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
$comprobante->setRfc($comprobantes->rfcComprobante);
$comprobante->setSda($comprobantes->sdaComprobante);
$comprobante->setSubtotal($comprobantes->subTotalComprobante);
$comprobante->setTotal($comprobantes->totalComprobante);
////----------------------------------------------------------
$encabezado->setFecha($comprobantes->fechaComprobante);
$encabezado->setFolio($comprobantes->folioComprobante);
$encabezado->setRfc($comprobantes->rfcComprobante);
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
    $detalle->setUnidadmedida();
    $array[$contador] = $detalle;
    $contador ++;
}
$control = count($conceptos);
$cn->Conectarse();
$tipo = "Entradas Manuales";
$paso = $dao->superMegaGuardadorEntradas($utilerias->generarFecha(), $encabezado, $array, $comprobante, $conceptos, $control, $idsucursal, $tipo, $usuario);
$cn->cerrarBd();