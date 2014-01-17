<?php

include './administracion.dao/dao.php';
include './administracion/administracion.clases/Producto.php';
$producto = new Producto();
$dao = new dao();
$producto->setProducto($_GET["txtNombreProducto"]);
$dao->guardarMarca($marca);
?>