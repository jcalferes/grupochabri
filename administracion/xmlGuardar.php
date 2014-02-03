
<?php

include './administracion.clases/Detalle.php';
include './administracion.clases/Encabezado.php';
include './administracion.dao/dao.php';
include_once '../daoconexion/daoConeccion.php';
session_start();
$encabezado = new Encabezado();
$detalle = new Detalle();
$dao = new dao();

$encabezado = $_SESSION['objEncabezado'];
$id = $dao->guardaEncabezado($encabezado);
$arrayDetalle = $_SESSION['arrayDetalle'];
$cn = new coneccion();
$cn->Conectarse();
foreach ($arrayDetalle as $detalle) {
    $error = $dao->guardaDetalle($detalle, $id);
    echo $error;
}
$cn->cerrarBd();
?>
