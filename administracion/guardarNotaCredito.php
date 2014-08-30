<?php

session_start();
include './administracion.dao/dao.php';
$idSucursal = $_SESSION["sucursalSesion"];
$idCliente = $_POST["idCliente"];
$total = $_POST["total"];
$idNotaCredito = $_POST["idNotasCredito"];
$folioVnta = $_POST["folioVnta"];
$dao = new dao();
$error = $dao->guardarNotaCredito($idCliente, $idSucursal, $total, $idNotaCredito, $folioVnta);
if ($error == "") {
    echo $error;
} else {
    echo $error;
}