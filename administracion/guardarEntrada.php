<?php
include_once './administracion.dao/dao.php';
$dao = new dao();
$cantidad = $_GET["cantidad"];
$id=$_GET["idProducto"];
$existencia = $_GET["existenciaActual"];
$datos=$dao->guardarEntradaProducto($cantidad, $id,$existencia);
echo $datos;