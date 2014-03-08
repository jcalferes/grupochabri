<?php

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
$usuario->setNombre($_GET["usuario"]);

$control = $dao->iniciarSesion($usuario);

if ($control == 1) {
    echo 1;
} else {
    while ($rs = mysql_fetch_array($control)) {
        $nombre = $rs['nombre'];
        $tiopousuario = $rs['idTipoUsuario'];
    }
    echo 0;
}
