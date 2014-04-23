<?php

session_start();
include './administracion.dao/dao.php';
$dao = new dao();
$codigo = $_GET["codigoProductoG"];
$sucursal = $_SESSION["sucursalSesion"];
$valida = $dao->verificaProductoGranel($codigo, $sucursal);
echo $valida;
