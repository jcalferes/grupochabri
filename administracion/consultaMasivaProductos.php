<?php
session_start();
include_once './administracion.dao/dao.php';
$idSucursal= $_SESSION["sucursalSesion"];
$dao = new dao();

$codigos=  json_decode($_GET["codigos"]);
$datosProductos=$dao->consultaInformacionProductosMasivos($codigos,$idSucursal);
 echo '' . json_encode($datosProductos) . '';