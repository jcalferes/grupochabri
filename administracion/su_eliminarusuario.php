<?php

include_once '../daoconexion/daoConeccion.php';
include_once './administracion.dao/dao.php';

$id = $_POST["id"];
$tipo = $_POST["tipo"];

$cn = new coneccion();
$dao = new dao();

$cn->Conectarse();
$ctrl = $dao->su_eliminarusuario($id, $tipo);
echo $ctrl;
$cn->cerrarBd();



