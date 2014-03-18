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

$dao = new dao();
$cn = new coneccion();
$cn->Conectarse();

$lafecha = date("d/m/Y h:i");

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
if ($valido == false) {
    echo 2;
} else {
    $validaCodigo = 1;
    $rechazaCodigo = 0;
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
    $paso = $dao->superMegaGuardadorEntradas($lafecha, $encabezado, $arrayDetalleEntrada, $comprobante, $conceptos, $control);
    if ($paso == false) {
        echo 1;
    } else {
        echo 0;
    }

    $cn->cerrarBd();
}
?>