<?php

include './administracion.dao/dao.php';
include './administracion.clases/Producto.php';
include './administracion.clases/Costo.php';
include './administracion.clases/Tarifa.php';
session_start();
$producto = new Producto();
$costo = new Costo();
$tarifa = new Tarifa();
$dao = new dao();
$idsucursal = $_SESSION["sucursalSesion"];

$lista = json_decode(stripslashes($_GET["lista"]));
$producto->setIdUnidadMedida($_GET["unidadMedida"]);
$producto->setIdGrupoProducto($_GET["grupoProducto"]);
$producto->setProducto($_GET["producto"]);
$producto->setIdMarca($_GET["marca"]);
$producto->setIdProveedor($_GET["proveedor"]);
$producto->setCodigoProducto($_GET["codigoProducto"]);
$producto->setCantidadMaxima($_GET["contenido"]);
$costo->setCosto($_GET["costoProducto"]);
$tarifa->setIdListaPrecio($lista);


$dao->editarProductoGranel($producto, $costo, $tarifa, $idsucursal);

