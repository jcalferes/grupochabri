<?php

include './administracion.dao/dao.php';
include './administracion.clases/ListaPrecio.php';
$lista = new ListaPrecio();
$dao = new dao();
$lista->setNombreListaPrecio($_GET["nombrelista"]);
$control = $dao->guardarListaPrecio($lista);
echo $control;
?>

