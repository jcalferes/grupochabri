<?php

include './administracion.clases/Usuario.php';
include './administracion.dao/dao.php';
include '../utileriasPhp/Utilerias.php';
session_start();

$dao = new dao();

$id = $_GET["id"];
if (isset($_SESSION["sucursalSesion"])) {
    $idsucursal = $_SESSION["sucursalSesion"];
    $control = $dao->eliminarUsuario($id);
    echo $control;
} else {
    echo "1";
}

