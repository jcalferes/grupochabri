<?php

include './administracion.clases/Proveedor.php';
include './administracion.clases/Direccion.php';
include './administracion.dao/dao.php';
session_start();
$proveedor = new Proveedor();
$direccion = new Direccion();
$dao = new dao();
$rfc = $_GET["rfc"];
if (!preg_match('/^[A-Z]{3,4}[ \-]?[0-9]{2}((0{1}[1-9]{1})|(1{1}[0-2]{1}))((0{1}[1-9]{1})|([1-2]{1}[0-9]{1})|(3{1}[0-1]{1}))[ \-]?[A-Z0-9]{3}$/D', $rfc)) {
    echo 2;
} else {
    $ctrlD = $_SESSION['controlDireccion'];
    if ($ctrlD == null) {
        $ctrlDireccion = 0;
    } else {
        $ctrlDireccion = 1;
    }

    if ($ctrlDireccion == 1) {
        $direccion = $_SESSION['objdireccion'];
        $x = $dao->guardarDireccion($direccion);
        if ($x == true) {
            $proveedor->setNombre($_GET["nombre"]);
            $proveedor->setRfc($rfc);
            $proveedor->setDiasCredito($_GET["diascredito"]);
            $proveedor->setDescuento($_GET["descuento"]);
            $id = $_SESSION['iddireccion'];
            $proveedor->setIdDireccion($id);
            $proveedor->setEmail($_GET["email"]);
            $dao->guardarProveedor($proveedor);
            unset($_SESSION["controlDireccion"]);
        } else {
            echo 3;
        }
    } else {
        echo 1;
    }
}
?>