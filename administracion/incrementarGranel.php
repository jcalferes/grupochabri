<?php

session_start();
include './administracion.dao/dao.php';
include_once '../daoconexion/daoConeccion.php';

$cn = new coneccion();
$dao = new dao();

$idsucursal = $_SESSION["sucursalSesion"];
$codigo = $_GET["codigo"];
$codigog = $_GET["codigog"];
$contenido = $_GET["contenido"];

$cn->Conectarse();
$ctrl = $dao->incrementaGranel($codigo, $codigog, $contenido, $idsucursal);
if ($ctrl == true) {
    echo 0;
} else {
    echo 1;
}





