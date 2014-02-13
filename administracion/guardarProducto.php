<?php

include './administracion.dao/dao.php';
include './administracion.clases/Producto.php';
include './administracion.clases/Costo.php';
include './administracion.clases/Tarifa.php';
$producto = new Producto();
$costo = new Costo();
$tarifa = new Tarifa();
$dao = new dao();
$lista = json_decode(stripslashes($_GET["lista"]));
$producto->setCantidadMaxima($_GET["max"]);
$producto->setCantidadMinima($_GET["min"]);
$producto->setProducto($_GET["producto"]);
$producto->setIdMarca($_GET["marca"]);
$producto->setIdProveedor($_GET["proveedor"]);
$producto->setCodigoProducto($_GET["codigoProducto"]);
$costo->setCosto($_GET["costoProducto"]);

//foreach ($lista as $valor) {
//    $pieces = explode("-", $valor);
//    $tarifa->setIdListaPrecio($pieces[1]);
//    $tarifa->setTarifa($pieces[0]);
//}
$tarifa->setIdListaPrecio($lista);
$dao->guardarProducto($producto, $costo, $tarifa);
?>