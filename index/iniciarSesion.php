<?php

session_start();
include './indes.clases/Usuario.php';
include './index.dao/dao.php';
include '../utileriasPhp/Utilerias.php';
include_once '../daoconexion/daoConeccion.php';
$dao = new dao();
$usuario = new Usuario();
$utilerias = new Utilerias();
$cn = new coneccion();
$cn->Conectarse();
$usuario->setPass($utilerias->genera_md5($_GET["pass"]));
$usuario->setUsuario($_GET["usuario"]);
$control = $dao->iniciarSesion($usuario);
if ($control == 1) {
    echo false;
} else {
    while ($rs = mysql_fetch_array($control)) {
        $nombre = $rs['nombre'];
        $tipousuario = $rs['idTipoUsuario'];
        $idsucursal = $rs['idSucursal'];
    }
    if ($tipousuario == 2) {
        $_SESSION["usuarioSesion"] = $usuario->getUsuario();
        $_SESSION["tipoSesion"] = $tipousuario;
        $_SESSION["sucursalSesion"] = $idsucursal;
    }
    echo $tipousuario;
    $cn->cerrarBd();
}
