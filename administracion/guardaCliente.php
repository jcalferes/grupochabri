<?php

include './administracion.clases/Cliente.php';
include './administracion.clases/Direccion.php';
include './administracion.dao/dao.php';
session_start();
$cliente = new Cliente();
$direccion = new Direccion();
$dao = new dao();
$rfc = $_GET["rfc"];

if (!preg_match('/^[A-Z]{3,4}[ \-]?[0-9]{2}((0{1}[1-9]{1})|(1{1}[0-2]{1}))((0{1}[1-9]{1})|([1-2]{1}[0-9]{1})|(3{1}[0-1]{1}))[ \-]?[A-Z0-9]{3}$/D', $rfc)) {
    echo 2;
} else {
    if (isset($_SESSION["controlDireccion"])) {
        $direccion = $_SESSION['objdireccion'];
        $x = $dao->guardarDireccion($direccion);
        if ($x == true) {
            $cliente->setNombre($_GET["nombre"]);
            $cliente->setTipoCliente($_GET["radios"]);
            $cliente->setRfc($rfc);
            $cliente->setDiasCredito($_GET["diascredito"]);
            $id = $_SESSION['iddireccion'];
            $cliente->setIdDireccion($id);
            $cliente->setEmail($_GET["email"]);
            $cliente->setDesctfactura($_GET["desctpf"]);
            $cliente->setDesctprontopago($_GET["desctpp"]);
            $dao->guardarCliente($cliente);
            unset($_SESSION["controlDireccion"]);
        } else {
            echo 3;
        }
    } else {
        echo 1;
    }
}
