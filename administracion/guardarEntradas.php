<?php

include '../utileriasPhp/Utilerias.php';
include './administracion.clases/Entradas.php';
include './administracion.dao/dao.php';
$utilerias = new Utilerias();
$entradas = new Entradas();
$dao = new dao();
$entradas->setCantidad($_GET["cant"]);
$entradas->setFecha($utilerias->generarFecha());
$entradas->setCodigoProducto($_GET["codigo"]);
$entradas->setUsuario("Pablo");
$dao->guardarEntradas($entradas);
?>
