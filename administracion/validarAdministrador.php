<?php

include_once './administracion.dao/dao.php';
include_once './administracion.clases/Usuario.php';
include_once '../utilerias/Utilerias.php';
$error = "";
$usuario = new Usuario();
$utilerias = new Utilerias();
$dao = new dao();
$usuario->setUsuario($_GET["usuario"]);
$usuario->setPass($utilerias->genera_md5($_GET["pass"], "1"));
$datos = $dao->validarUsuario($usuario);
if ($datos == false) {
    $error = mysql_error();
} else {
    $dato = mysql_affected_rows();
}
if ($dato > 0) {
    $error = 1;
}
else{
    $error="Acceso Denegado";
}
echo $error;
