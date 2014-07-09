<?php

session_start();
include './administracion.dao/dao.php';
include_once '../daoconexion/daoConeccion.php';

$sucursal = $_SESSION["sucursalSesion"];
$usuario = $_SESSION["usuarioSesion"];
$folio = $_GET["folio"];
$observ = $_GET["observcancelacion"];
$reutilizar = $_GET["reutilizar"];

$dao = new dao();
$cn = new coneccion();

$cn->Conectarse();
$control = $dao->efectuarCancelacion($folio, $sucursal, $observ, $usuario);
if($reutilizar == 1){
    $dao->reutilizarCancelacion($folio, $sucursal);
}
$cn->cerrarBd();

if ($control == true) {
    $r = 0;
} else {
    $r = 1;
}
echo $r;



