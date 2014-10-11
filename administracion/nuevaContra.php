<?php

session_start();
include './administracion.dao/dao.php';
include '../daoconexion/daoConeccion.php';
include '../utilerias/Utilerias.php';
$cn = new coneccion();
$dao = new dao();
$utilerias = new Utilerias();
$cn->Conectarse();
$usuario = $_SESSION["usuarioSesion"];
$pass = md5($_GET["contra"]);
$rs = $dao->actualizarPass($usuario, $pass);
if ($rs == false) {
    echo mysql_error();
} else {
    echo 'Exito. Contraseña Actualizada.';
}