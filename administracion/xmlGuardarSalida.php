
<?php

include './administracion.clases/Detalle.php';
include './administracion.clases/Encabezado.php';
include './administracion.dao/dao.php';
include_once '../daoconexion/daoConeccion.php';
include '../utileriasPhp/Utilerias.php';
session_start();
$idsucursal = $_SESSION["sucursalSesion"];

$encabezadoSalida = new Encabezado();
$detalle = new Detalle();
$dao = new dao();
$cn = new coneccion();
$utilerias = new Utilerias();

$encabezadoSalida = $_SESSION['objEncabezadoSalida'];
$arrayDetalleSalida = $_SESSION['arrayDetalleSalida'];
$lafecha = $utilerias->generarFecha();

$rfccabezera = $encabezadoSalida->getRfc();
$rfcorigen = "CABJ830923TW9";
if ($rfccabezera != $rfcorigen) {
    echo 10;
} else {
    $cn->Conectarse();
    $dao->MiniGuardadorSalidas($encabezadoSalida, $arrayDetalleSalida, $lafecha, $idsucursal);
    $cn->cerrarBd();
}
?>
