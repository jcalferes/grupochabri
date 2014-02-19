<?php

include './administracion.clases/Detalle.php';
include './administracion.clases/Encabezado.php';
include './administracion.dao/dao.php';
include '../utileriasPhp/Utilerias.php';
include_once '../daoconexion/daoConeccion.php';
session_start();

$detalle = new Detalle();
$encabezado = new Encabezado();
$utilerias = new Utilerias();
$dao = new dao();
$cn = new coneccion();
$cn->Conectarse();

$lafecha = $utilerias->generarFecha();

$encabezado = $_SESSION['objEncabezadoEntrada'];
$arrayDetalleEntrada = $_SESSION['arrayDetalleEntrada'];

$datos = json_decode($_POST['datos']);
$comprobante = $datos[1];
$conceptos = $datos[0];

$rfc = $encabezado->getRfc();

$valido = $dao->validarExistenciaProductoProveedor($codigo);

//foreach ($conceptos as $concepto) {
//    $codigo = $concepto->codigo;
//
//    if ($valido !== false) {
//        $rs = mysql_fetch_array($valido);
//        if ($codigo === $rs[codigoProducto]) {
//            mysql_data_seek($valido, 0);
//            echo 0;
//        } else {
//            echo $codigo;
//            return false;
//        }
//    } else {
//        echo $codigo;
//        return false;
//    }
//}

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

