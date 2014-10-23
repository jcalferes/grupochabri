<?php

include_once '../daoconexion/daoConeccion.php';
include_once './administracion.dao/dao.php';
include_once '../utileriasPhp/Utilerias.php';

$cn = new coneccion();
$dao = new dao();
$ut = new Utilerias();

$nombre = $_POST["nombre"];
$apaterno = $_POST["apaterno"];
$amaterno = $_POST["amaterno"];
$tipousuario = $_POST["tipousuario"];
$sucursal = $_POST["sucursal"];
$bndeditpass = $_POST["bndeditpass"];
$id = $_POST["id"];

if ($bndeditpass == 1) {
    $pass = $_POST["pass"];
    $codpass = $ut->genera_md5($pass);

    $query = "update usuarios set nombre = '$nombre', apellidoPaterno = '$apaterno', apellidoMaterno = '$amaterno', password = '$codpass', idtipousuario = '$tipousuario', idSucursal = '$sucursal' "
            . "where idUsuario = '$id'";
} else {
    $query = "update usuarios set nombre = '$nombre', apellidoPaterno = '$apaterno', apellidoMaterno = '$amaterno', idtipousuario = '$tipousuario', idSucursal = '$sucursal' "
            . "where idUsuario = '$id'";
}

$cn->Conectarse();
$ctrl = $dao->su_editarusuario($query);
echo $ctrl;
$cn->cerrarBd();
