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

$comprobante->setDescuentoFactura(floatval($compbt->desctFactura));
$comprobante->setDescuentoProntoPago(floatval($compbt->desctProntoPago));
$comprobante->setDescuentoGeneral(floatval($compbt->desctGeneral));
$comprobante->setDescuentoPorProducto(floatval($compbt->desctPorProductos));
$comprobante->setDescuentoTotal(floatval($compbt->desctTotal));
$comprobante->setSda(floatval($compbt->sda));
$comprobante->setConIva(floatval($compbt->iva));
$comprobante->setTotal(floatval($compbt->total));

$rfc = $encabezado->getRfc();
$valido = $dao->validarExistenciaProductoProveedor($rfc);
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

$control = count($conceptos);
$dao->superMegaGuardadorEntradas($lafecha, $encabezado, $arrayDetalleEntrada, $comprobante, $conceptos, $control);




//$cpto = new Concepto();
//for ($i = 0; $i < $control; $i++) {
//    $detalle = $arrayDetalleEntrada[$i];
//    $controlDetalle = $dao->guardarDetalle($detalle, $idEncabezado);
//    if ($controlDetalle == false) {
//        echo 1;
//        break;
//    }
//    $cpto = $conceptos[$i];
//    $cantidadExistencia = $dao->validarExistenciaProductoExistencia($cpto);
//    if ($cantidadExistencia == null) {
//        echo 1;
//        break;
//    } else {
//        $cantidadXml = $detalle->getCantidad();
//        $nuevacantidad = $cantidadXml + $cantidadExistencia;
//        $dao->actulizaExistencias($cpto, $nuevacantidad);
//    }
//}
?>