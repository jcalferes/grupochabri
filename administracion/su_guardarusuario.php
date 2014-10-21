<?php

include_once '../daoconexion/daoConeccion.php';
include_once './administracion.dao/dao.php';
include_once '../utileriasPhp/Utilerias.php';

$c = new coneccion();
$dao = new dao();
$u = new Utilerias();

$nombre = $_POST["nombre"];
$apaterno = $_POST["apaterno"];
$amaterno = $_POST["amaterno"];
$tipousuario = $_POST["tipousuario"];
$usuario = $_POST["usuario"];
$pass = $u->genera_md5($_POST["pass"]);
$sucursal = $_POST["sucursal"];

$c->Conectarse();
$ctrl = $dao->su_guardarusuario($nombre, $apaterno, $amaterno, $tipousuario, $usuario, $pass, $sucursal);
echo $ctrl;
$c->cerrarBd();

