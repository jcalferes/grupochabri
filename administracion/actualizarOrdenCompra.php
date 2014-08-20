<?php

session_start();
include './administracion.dao/dao.php';
$dao = new dao();
$array = $_POST["data"];
$idsucursal = $_SESSION["sucursalSesion"];
$detalle = json_decode($array);
$error = $dao->actualizarOrdenCompraMostrador($detalle[0], $idsucursal, $detalle[1]);
echo $error;