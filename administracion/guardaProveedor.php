<?php

include './administracion.clases/proveedores.php';
include './administracion.clases/direccion.php';
include './administracion.dao/dao.php';
session_start();
$proveedor = new proveedores();
$direccion = new direccion();
$dao = new dao();
if ($_SESSION["controlDireccion"] == 1) {
    $direccion = $_SESSION['objdireccion'];
    $dao->guardarDireccion($direccion);
    $proveedor->setNombre($_GET["nombre"]);
    $proveedor->setRfc($_GET["rfc"]);
    $proveedor->setDiasCredito($_GET["diascredito"]);
    $proveedor->setDescuento($_GET["descuento"]);
    $id = $_SESSION['iddireccion'];
    $proveedor->setIdDireccion($id);
    $dao->guardarProveedor($proveedor);
} else {
    echo 1;
}
?>