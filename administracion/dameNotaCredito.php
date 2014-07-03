<?php
session_start();
include_once './administracion.dao/dao.php';
$dao = new dao();
$rfc = "";
$rfc = $_GET["rfc"];
$idSucursal = $_SESSION["sucursalSesion"];
