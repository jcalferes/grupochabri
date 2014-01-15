<?php
include './administracion.dao/dao.php';
include './administracion.clases/Marca.php';
$marca = new Marca();
$dao = new dao();
$marca->setMarca($_GET["nombre"]);
$dao->guardarMarca($marca);
