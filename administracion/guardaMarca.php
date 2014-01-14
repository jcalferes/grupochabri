<?php
include './administracion.dao/dao.php';
include './administracion.clases/marcas.php';
$marca = new marcas();
$dao = new dao();
$marca->setMarca($_GET["nombre"]);
$dao->guardarMarca($marca);
?>