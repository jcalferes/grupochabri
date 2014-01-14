<?php

session_start();
include './administracion.dao/dao.php';
include './administracion.clases/direccion.php';
$direccion = new direccion();
$direccion->setCalle($_GET["calle"]);
$direccion->setNumeroexterior($_GET["numeroexterior"]);
$direccion->setNumerointerior($_GET["numerointerior"]);
$direccion->setPostal($_GET["postal"]);
$direccion->setColonia($_GET["colonia"]);
$_SESSION['objdireccion'] = $direccion;
$_SESSION['controlDireccion'] = 1;
?>

