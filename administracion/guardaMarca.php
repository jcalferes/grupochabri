<?php

include './administracion.dao/dao.php';
include './administracion.clases/Marca.php';
$marca = new Marca();
$dao = new dao();
$marca->setMarca($_GET["nombre"]);
$ctrl = $dao->guardarMarca($marca);
if ($ctrl === 0) {
    echo 0;
}
if ($ctrl === 999) {
    echo 999;
}
?>