<?php

session_start();
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
//$nombrepc = gethostbyaddr($_SERVER['REMOTE_ADDR']);
$nombrepc = "HOME";
$validapc = $dao->verificarMaquina($nombrepc);
if ($validapc == "VALIDA") {
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
} else {
    echo 777;
    $cn->cerrarBd();
}