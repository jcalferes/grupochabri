<?php

include_once './administracion.dao/dao.php';
include_once './administracion.clases/transaccionDetalles.php';
include_once './administracion.clases/transaccionEncabezados.php';
session_start();
$idsucursal = $_SESSION["sucursalSesion"];
$sucursal = $_POST["sucursal"];
$transf = $_POST["transf"];
$lafecha = date("d/m/Y");
$dao = new dao();
$datos = json_decode($_POST['datos']);

$dao->guardarTransferenciaPedido($datos, $lafecha, $idsucursal, $sucursal,$transf);
