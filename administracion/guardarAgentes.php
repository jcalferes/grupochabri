<?php

include_once '../daoconexion/daoConeccion.php';
include './administracion.dao/dao.php';
$cn = new coneccion();
$dao = new dao();

$datos = json_decode($_POST['adatos']);

$idproveedor = $datos[0];
$nombre = $datos[1];
$telefonos = $datos[2];
$emails = $datos[3];

$ctrltelefonos = count($telefonos);
$ctrlemails = count($emails);

$cn->Conectarse();
$ctrl = $dao->guardarAgentes($idproveedor, $nombre, $telefonos, $emails, $ctrltelefonos, $ctrlemails);
$cn->cerrarBd();

if ($ctrl == true) {
    echo 0;
} else {
    echo 1;
}
