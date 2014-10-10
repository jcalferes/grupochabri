<?php

include_once './administracion.dao/dao.php';
$dao = new dao();
$cantidad = $_GET["cantidad"];
$idSucursal = $_GET["idProducto"];
$existencia = $_GET["existenciaActual"];
$datos = $dao->guardarEntradaProducto($cantidad, $idSucursal, $existencia);
echo $datos;
