<?php
include './administracion.dao/dao.php';
include './administracion.clases/ListaPrecio.php';
$dao = new dao();
$ListaPrecio = new ListaPrecio();
$ListaPrecio->setNombreListaPrecio($_GET["nombrelista"]);
$datos = $dao->guardarListaPrecio($ListaPrecio);
echo $datos;




