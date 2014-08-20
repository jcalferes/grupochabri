<?php

session_start();
include './administracion.dao/dao.php';
include './administracion.clases/CajaInicial.php';
include './administracion.clases/Usuario.php';
$caja = new CajaInicial();
$dao = new dao();
$usuario = new Usuario();
$usuario->setUsuario($_GET["us"]);
$usuario->setPass(md5($_GET["pas"]));
$rsUsuario = $dao->validarUsuario($usuario);
if ($rsUsuario == false) {
    echo mysql_error();
} else {
    if (mysql_affected_rows() > 0) {
        $caja->setFecha(date("d/m/Y"));
        $caja->setIdSucursal($_SESSION["sucursalSesion"]);
        $caja->setIngreso($_GET["cant"]);
        $rsCaja = $dao->guardarIngresoCaja($caja);
        if ($rsCaja == false) {
            echo mysql_error();
        } else {
            echo 1;
        }
    } else {
        echo 'Ingrese un Usuario y pass correcto';
    }
}


