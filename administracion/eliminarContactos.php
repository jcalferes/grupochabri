<?php

include './administracion.dao/dao.php';
include_once '../daoconexion/daoConeccion.php';

$dao = new dao();
$cn = new coneccion();

$id = $_GET["id"];
$tipo = $_GET["tipo"];
//0 = telefono
//1 = email
if ($tipo == 0) {
    $rs = $dao->eliminartTelefonos($id);
} else {
    $rs = $dao->eliminarEmails($id);
}
echo $rs;


