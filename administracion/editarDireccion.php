
<?php

session_start();
include './administracion.clases/Direccion.php';
$direccion = new Direccion();
$direccion->setidDireccion($_GET["extra"]);
$direccion->setCalle($_GET["calle"]);
$direccion->setNumeroexterior($_GET["numeroexterior"]);
$direccion->setNumerointerior($_GET["numerointerior"]);
$direccion->setCruzamientos($_GET["cruzamientos"]);
$direccion->setIdPostal($_GET["idcpostales"]);
$_SESSION['objdireccion'] = $direccion;
$_SESSION['controlDireccion'] = 1;


