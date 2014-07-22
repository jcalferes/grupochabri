<?php

include_once '../daoconexion/daoConeccion.php';
include './administracion.dao/dao.php';

$cn = new coneccion();
$dao = new dao();

$idImgslider = $_GET["idImgslider"];
$idSucursal = $_GET["idSucursal"];
$ruta = $_GET["ruta"];

$cn->Conectarse();
$ctrl = $dao->borrarSlider($idImgslider,$idSucursal,$ruta);
if($ctrl != false){
    echo 777;
}else{
    echo 666;
}
$cn->cerrarBd();