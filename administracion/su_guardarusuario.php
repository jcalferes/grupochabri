<?php

include_once '../daoconexion/daoConeccion.php';
include_once './administracion.dao/dao.php';

$c = new coneccion();
$dao = new dao();

$nombre = $_POST["nombre"];
$c->Conectarse();
$dao->testbd($nombre);
$c->cerrarBd();
echo ($nombre);

