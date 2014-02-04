
<?php

include './administracion.clases/Detalle.php';
include './administracion.clases/Encabezado.php';
include './administracion.dao/dao.php';
include_once '../daoconexion/daoConeccion.php';
session_start();
$$encabezadoEntrada = new Encabezado();
$detalle = new Detalle();
$dao = new dao();

$$encabezadoEntrada = $_SESSION['objEncabezadoSalida'];
$id = $dao->guardaEncabezado($$encabezadoEntrada);
$arrayDetalleSalida = $_SESSION['arrayDetalleSalida'];
$cn = new coneccion();
$cn->Conectarse();
foreach ($arrayDetalleSalida as $detalle) {
    $error = $dao->guardaDetalle($detalle, $id);
    echo $error;
}
$cn->cerrarBd();
?>
