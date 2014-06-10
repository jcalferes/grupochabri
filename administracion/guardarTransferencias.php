<?php
include_once './administracion.dao/dao.php';
include_once './administracion.clases/transaccionDetalles.php';
include_once './administracion.clases/transaccionEncabezados.php';
session_start();
$idsucursal = $_SESSION["sucursalSesion"];
$sucursal = $_POST["sucursal"];
$lafecha = date("d/m/Y");
$dao = new dao();
$datos = json_decode($_POST['datos']);

$dao->guardarRequisicionPedido($datos, $lafecha, $idsucursal,$sucursal);


