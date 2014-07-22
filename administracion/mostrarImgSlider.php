<?php

include_once '../daoconexion/daoConeccion.php';
include './administracion.dao/dao.php';

$dao = new dao();
$cn = new coneccion();

$cn->Conectarse();
$data = $dao->mostrarImgSlider();
if ($data == false) {
    echo "<center><span>NO HAY IMAGENES</span></center>";
} else {
    while ($rs = mysql_fetch_array($data)) {
        $valor ="";
        $valor=$rs['ruta'];
        echo "<div class='col-sm-6 col-md-2 conte' id=''><div class='thumbnail' id=''><img src='".  utf8_decode($rs['ruta'])."' style='width: 100px; height: 88px;'><div class='caption'><center><button type='button' class='btn btn-default btn-block' onclick='borrarSlider(\"$rs[idImgslider]\",\"$rs[idSucursal]\",\"".utf8_decode($rs['ruta'])."\");'><span class='glyphicon glyphicon-remove'></span></button></center></div></div></div>";
    }
}
$cn->cerrarBd();