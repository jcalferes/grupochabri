<?php
include_once './administracion.dao/dao.php';
include_once './administracion.clases/transaccionDetalles.php';
include_once './administracion.clases/transaccionEncabezados.php';
session_start();
$idsucursal = $_SESSION["sucursalSesion"];
$lafecha = date("d/m/Y h:i");
$dao = new dao();
$datos = json_decode($_POST['datos']);

$dao->guardarTranferenciaPedido($datos, $lafecha);


