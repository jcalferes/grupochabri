<?php

include './administracion.dao/dao.php';
session_start();
$sucursal = $_SESSION["sucursalSesion"];
$dao = new dao();
$usuario = $_GET["usuario"];
$datos = $dao->consultarExistenciaUsuario($usuario);
if ($datos != 0) {
    $rs = mysql_fetch_array($datos);
    $cualsucursal = $rs['idSucursal'];
    if ($sucursal == $cualsucursal) {
        echo '' . json_encode($rs) . '';
    } else {
        echo 999;
    }
} else {
    echo 0;
}

