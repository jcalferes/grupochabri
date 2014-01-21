<?php

include './administracion.dao/dao.php';
include './administracion.clases/Producto.php';
$producto = new Producto();
$dao = new dao();
$producto->setProducto($_GET["txtNombreProducto"]);
$producto->setProducto($_GET["producto"]);
$producto->setIdMarca($_GET["marca"]);
$producto->setIdProveedor($_GET["proveedor"]);
$producto->setCodigoProducto($_GET["codigoProducto"]);
$producto->setIdListaPrecios($_GET["listaPrecios"]);
$_SESSION['objproducto'] = $producto;
$_SESSION['controlproducto'] = 1;
//$dao->guardarProducto($producto);
?>