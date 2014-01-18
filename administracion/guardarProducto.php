<?php

include './administracion.dao/dao.php';
include './administracion.clases/Producto.php';
$producto = new Producto();
$dao = new dao();
$producto->setProducto($_GET["txtNombreProducto"]);
$dao->guardarMarca($marca);
$producto->setProducto($_GET["producto"]);
$producto->setIdMarca($_GET["marca"]);
$producto->setIdProveedor($_GET["proveedor"]);
$producto->setCodigoProducto($_GET["codigoProducto"]);
$producto->setIdListaPrecios($_GET["listaPrecios"]);

$dao->guardarProducto($producto);
?>