<?php

session_start();
include_once '../daoconexion/daoConeccion.php';
include './administracion.dao/dao.php';

$dao = new dao();
$cn = new coneccion();

$monto = $_GET["monto"];
$tipopago = $_GET["tipopago"];
$referencia = $_GET["referencia"];
$observ = $_GET["observ"];
echo 'asdasds';

