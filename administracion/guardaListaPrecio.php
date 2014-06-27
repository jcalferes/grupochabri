<?php

include './administracion.dao/dao.php';
include './administracion.clases/ListaPrecio.php';
$dao = new dao();
$ListaPrecio = new ListaPrecio();
$ListaPrecio->setNombreListaPrecio($_GET["nombrelista"]);
$datos = $dao->guardarListaPrecio($ListaPrecio);
if ($datos === 0) {
    echo 0;
}
if ($datos === 1) {
    echo 1;
}
if ($datos === 999) {
    echo 999;
}




