<?php
session_start();
include '../daoconexion/daoConeccion.php';
include './administracion.dao/dao.php';
include './administracion.clases/Encabezado.php';
$en = new Encabezado();
$idSucursal = $_SESSION["sucursalSesion"];
$usuario = $_SESSION["usuarioSesion"];
$dao = new dao();
$datos = json_decode(stripslashes($_POST['data']));
$encabezado = $datos[0];
$detalle = $datos[1];
$error = $dao->guardarventas($encabezado, $detalle, $idSucursal,$usuario);
if ($error == "") {
    $error = 0;
}
echo $error;
