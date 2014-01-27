<?php
include './administracion.dao/dao.php';
include './administracion.clases/Producto.php';
include './administracion.clases/Costo.php';
$producto = new Producto();
$costo = new Costo();
$dao = new dao();
$producto->setProducto($_GET["producto"]);
$producto->setIdMarca($_GET["marca"]);
$producto->setIdProveedor($_GET["proveedor"]);
$producto->setCodigoProducto($_GET["codigoProducto"]);
$costo->setCosto($_GET["costoProducto"]);
$dao->guardarProducto($producto,$costo);
?>