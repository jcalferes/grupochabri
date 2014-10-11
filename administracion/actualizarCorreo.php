<?php

include './administracion.dao/dao.php';
include '../daoconexion/daoConeccion.php';
$cn = new coneccion();
$cn->Conectarse();
$dao = new dao();
$id = $_GET["idCorreo"];
$telefono = $_GET["correo"];
$datos = $dao->actualizarCorreo($id, $telefono);
if($datos == false){
    echo mysql_error();
}
else{
    echo 'Exito!! Datdos actualizados.';
}