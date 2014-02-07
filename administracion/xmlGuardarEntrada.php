<?php

include './administracion.clases/Detalle.php';
include './administracion.clases/Encabezado.php';
include './administracion.dao/dao.php';
include_once '../daoconexion/daoConeccion.php';
session_start();

$detalle = new Detalle();
$encabezado = new Encabezado();
$dao = new dao();
$cn = new coneccion();

$encabezadoEntrada = $_SESSION['objEncabezadoEntrada'];
$idcabeza = $dao->guardaEncabezado($encabezadoEntrada);

$arrayDetalleEntrada = $_SESSION['arrayDetalleEntrada'];
$datos = json_decode($_POST['datos']);
$control = count($datos);
$cn->Conectarse();
for ($i = 0; $i < $control; $i++) {
    $detalle = $arrayDetalleEntrada[$i];


    $unidadmedida = $detalle->getUnidadmedida();
    $subtotal = $detalle->getSubtotal();
    $cantidad = $detalle->getCantidad();
    $id = $datos[$i]->ident;
    $nombre = $detalle->getNombre();
    $preciounit = $datos[$i]->coda;
    $idencabezado = $idcabeza;

    $sql = "INSERT INTO facturaDetalles (unidadMedidaDetalle, subtotalDetalle, cantidadDetalle, idDetalle, nombreDetalle, precioUnitarioDetalle, idFacturaEncabezados) VALUES ('" . $unidadmedida . "','" . $subtotal . "','" . $cantidad . "','" . $id . "' ,'" . $nombre . "','" . $preciounit . "', '" . $idencabezado . "')";
    $dao->guardaDetalleEntrada($sql);
}

