<?php

include './administracion.clases/Proveedor.php';
include './administracion.clases/Direccion.php';
include './administracion.dao/dao.php';
session_start();
$proveedor = new Proveedor();
$direccion = new Direccion();
$dao = new dao();
$rfc = $_GET["rfc"];

