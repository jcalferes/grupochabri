<?php

include './administracion.clases/direccion.php';
include './administracion.dao/dao.php';
$direccion = new direccion();
$dao = new dao();

$direccion->setCalle($_GET["calle"]);
$direccion->setNumeroexterior($_GET["numeroexterior"]);
$direccion->setNumerointerior($_GET["numerointerior"]);
$direccion->setPostal($_GET["postal"]);
$direccion->setColonia($_GET["colonia"]);

$dao->guardarDireccion($direccion);
?>

