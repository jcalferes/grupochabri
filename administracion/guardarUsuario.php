<?php

include './administracion.clases/Usuario.php';
include './administracion.dao/dao.php';
include '../utileriasPhp/Utilerias.php';
session_start();

$usuario = new Usuario();
$utilerias = new Utilerias();
$dao = new dao();

$usuario->setTipousuario($_GET["tipousuario"]);
$usuario->setUsuario($_GET["usuario"]);
$usuario->setNombre($_GET["nombre"]);
$usuario->setPaterno($_GET["paterno"]);
$usuario->setMaterno($_GET["materno"]);
$usuario->setPass($utilerias->genera_md5($_GET["pass"]));
if (isset($_SESSION["sucursalSesion"])) {
    $idsucursal = $_SESSION["sucursalSesion"];
    $control = $dao->guardarUsuario($usuario, $idsucursal);
    echo $control;
} else {
    echo"1";
}



