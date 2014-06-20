<?php
session_start();
include_once '../daoconexion/daoConeccion.php';
include './administracion.dao/dao.php';

$cn = new coneccion();
$dao = new dao();

$idcliente = $_GET["cantidad"];
$idcliente = $_GET["idcliente"];
$sucursal = $_SESSION["sucursalSesion"];

$dao->guardarNotasCredito($idcliente, $cantidad, $sucursal);

