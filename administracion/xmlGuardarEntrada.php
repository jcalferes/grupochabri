<?php

include './administracion.clases/Detalle.php';
include './administracion.clases/Encabezado.php';
include './administracion.clases/Comprobante.php';
include './administracion.clases/Concepto.php';
include './administracion.dao/dao.php';
include '../utileriasPhp/Utilerias.php';
include_once '../daoconexion/daoConeccion.php';
session_start();

$detalle = new Detalle();
$encabezado = new Encabezado();
$comprobante = new Comprobante();
$concepto = new Concepto();

$utilerias = new Utilerias();
$dao = new dao();
$cn = new coneccion();
$cn->Conectarse();

$lafecha = $utilerias->generarFecha();

$encabezado = $_SESSION['objEncabezadoEntrada'];
$arrayDetalleEntrada = $_SESSION['arrayDetalleEntrada'];

$datos = json_decode($_POST['datos']);
$compbt = $datos[1];
$conceptos = $datos[0];

$comprobante->setDescuentoFactura(floatval($compbt->descuentofactura));
$comprobante->setDescuentoProntoPago(floatval($compbt->descuentoprontopago));
$comprobante->setDescuentoGeneral(floatval($compbt->descuentogeneral));
$comprobante->setDescuentoPorProducto(floatval($compbt->descuentoporproductos));
$comprobante->setDescuentoTotal(floatval($compbt->descuentototal));
$comprobante->setSda(floatval($compbt->sda));
$comprobante->setConIva(floatval($compbt->iva));
$comprobante->setTotal(floatval($compbt->total));

$rfc = $encabezado->getRfc();
$valido = $dao->validarExistenciaProductoProveedor();
$validaCodigo = 1;
$recchazaCodigo = 0;
foreach ($conceptos as $concepto) {
    $ads = $concepto->codigo;
    while ($rs = mysql_fetch_array($valido)) {
        if ($ads != $rs['codigoProducto']) {
            $rechazaCodigo = $concepto->codigo;
        } else {
            $validaCodigo = 0;
        }
    }
    mysql_data_seek($valido, 0);

    if ($validaCodigo != 0) {
        echo $rechazaCodigo;
        return false;
    }
}

$idEncabezado = $dao->guardarEncabezado($encabezado, $lafecha);
$idComprobante = $dao->guardarComprobante($encabezado, $comprobante, $lafecha);

$control = count($conceptos);

for ($i = 0; $i < $control; $i++) {
    $detalle = $arrayDetalleEntrada[$i];
    $controlDetalle = $dao->guardarDetalle($detalle, $idEncabezado);
    if ($controlDetalle == false) {
        echo 1;
        return false;
    }
}

echo 1;















//$encabezadoEntrada = $_SESSION['objEncabezadoEntrada'];
//$idcabeza = $dao->guardaEncabezado($encabezadoEntrada);
//$arrayDetalleEntrada = $_SESSION['arrayDetalleEntrada'];
//$datos = json_decode($_POST['datos']);
//$control = count($datos);
//$cn->Conectarse();
//for ($i = 0; $i < $control; $i++) {
//    $detalle = $arrayDetalleEntrada[$i];
//
//
//    $unidadmedida = $detalle->getUnidadmedida();
//    $subtotal = $detalle->getSubtotal();
//    $cantidad = $detalle->getCantidad();
//    $id = $datos[$i]->ident;
//    $nombre = $detalle->getNombre();
//    $preciounit = $datos[$i]->coda;
//    $idencabezado = $idcabeza;
//
//    $sql = "INSERT INTO facturaDetalles (unidadMedidaDetalle, subtotalDetalle, cantidadDetalle, idDetalle, nombreDetalle, precioUnitarioDetalle, idFacturaEncabezados) VALUES ('" . $unidadmedida . "','" . $subtotal . "','" . $cantidad . "','" . $id . "' ,'" . $nombre . "','" . $preciounit . "', '" . $idencabezado . "')";
//    $dao->guardaDetalleEntrada($sql);
//}
?>
