<?php

session_start();
$_SESSION["usuarioSesion"] = "";
$_SESSION["tipoSesion"] = "";
$_SESSION["sucursalSesion"] = "";
include './index.clases/sesion.php';
include './index.dao/index.dao.php';
include '../utileriasPhp/Utilerias.php';
include_once '../daoconexion/daoConeccion.php';
$dao = new dao();
$usuario = new Usuario();
$utilerias = new Utilerias();
$cn = new coneccion();
$link = $cn->Conectarse();
$usuario->setPass($utilerias->genera_md5($_GET["pass"]));
$usuario->setUsuario($_GET["usuario"]);
$control = $dao->iniciarSesion($usuario);
if ($control == 1) {
    echo 666;
} else {
    while ($rs = mysql_fetch_array($control)) {
        $nombre = $rs['nombre'];
        $idusuario = $rs['idUsuario'];
        $tipousuario = $rs['idtipousuario'];
        $idsucursal = $rs['idSucursal'];
    }
    $_SESSION["usuarioSesion"] = $idusuario;
    $_SESSION["tipoSesion"] = $tipousuario;
    $_SESSION["sucursalSesion"] = $idsucursal;
    echo $tipousuario;
    $cn->cerrarBd();
}
