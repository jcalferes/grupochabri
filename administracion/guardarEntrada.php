<?php
include_once './administracion.dao/dao.php';
$dao = new dao();
$cantidad = $_GET["cantidad"];
$id=$_GET["idProducto"];
$datos=$dao->guardarEntradaProducto($cantidad, $id);
echo $datos;