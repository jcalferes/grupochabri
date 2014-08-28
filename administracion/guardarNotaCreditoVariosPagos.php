<?php

session_start();
include './administracion.dao/dao.php';
$idSucursal = $_SESSION["sucursalSesion"];
$idCliente = $_POST["idCliente"];
$total = $_POST["total"];
$idNotaCredito = $_POST["idNotasCredito"];
$folioVnta = $_POST["folioVnta"];
$tipoPago = $_POST["tipoPago"];
$cantidad = $_POST["cantidad"];
$totalCreditoEnviado = $_POST["totalCredito"];
$dao = new dao();
$error = $dao->guardarNotaCreditoAcompletar($idCliente, $idSucursal, $total, $idNotaCredito, $folioVnta, $tipoPago, $cantidad, $totalCreditoEnviado);
if ($error == "") {
    echo $error;
} else {
    echo $error;
}