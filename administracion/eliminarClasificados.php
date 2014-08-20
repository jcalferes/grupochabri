<?php
include_once './administracion.dao/dao.php';
include_once './administracion.clases/clasificados.php';
include_once './administracion.clases/tiposProducto.php';
$dao = new dao();


$imagenesBorradas =  $_GET["idImagen"];
$imagen =  $_GET["imagen"];

    $dao->eliminandoImagenes($imagenesBorradas,$imagen);

