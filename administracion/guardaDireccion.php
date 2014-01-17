<?php

session_start();
include './administracion.clases/Direccion.php';
$direccion = new Direccion();
$direccion->setCalle($_GET["calle"]);
$direccion->setNumeroexterior($_GET["numeroexterior"]);
$direccion->setNumerointerior($_GET["numerointerior"]);
$direccion->setPostal($_GET["postal"]);
$direccion->setColonia($_GET["colonia"]);
$_SESSION['objdireccion'] = $direccion;
$_SESSION['controlDireccion'] = 1;
?>

