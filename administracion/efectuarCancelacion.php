<?php

session_start();
include './administracion.dao/dao.php';
include_once '../daoconexion/daoConeccion.php';

$sucursal = $_SESSION["sucursalSesion"];
$folio = $_GET["folio"];

$dao = new dao();
$cn = new coneccion();

$cn->Conectarse();
$control = $dao->efectuarCancelacion($folio, $sucursal);




