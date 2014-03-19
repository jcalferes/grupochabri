
<?php

session_start();
include './administracion.clases/Direccion.php';
$direccion = new Direccion();
$direccion->setPostal($_GET["postal"]);
$direccion->setCiudad(utf8_decode($_GET["ciudad"]));
$direccion->setColonia(utf8_decode($_GET["colonia"]));
$direccion->setEstado(utf8_decode($_GET["estado"]));
$direccion->setidDireccion($_GET["extra"]);
$direccion->setCalle($_GET["calle"]);
$direccion->setNumeroexterior($_GET["numeroexterior"]);
$direccion->setNumerointerior($_GET["numerointerior"]);
$direccion->setCruzamientos($_GET["cruzamientos"]);
//$direccion->setIdPostal($_GET["idcpostales"]);
$_SESSION['objdireccion'] = $direccion;
$_SESSION['controlDireccion'] = 1;


