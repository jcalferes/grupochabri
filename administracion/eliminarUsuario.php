<?php

include './administracion.clases/Usuario.php';
include './administracion.dao/dao.php';
include '../utileriasPhp/Utilerias.php';
session_start();

$dao = new dao();

$idSucursal = $_GET["id"];
if (isset($_SESSION["sucursalSesion"])) {
    $idsucursal = $_SESSION["sucursalSesion"];
    $control = $dao->eliminarUsuario($idSucursal);
    echo $control;
} else {
    echo "1";
}

