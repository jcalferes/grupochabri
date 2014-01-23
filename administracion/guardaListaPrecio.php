<?php
include './administracion.dao/dao.php';
include './administracion.clases/ListaPrecio.php';
$dao = new dao();
$ListaPrecio = new ListaPrecio();
$dao->guardarListaPrecio($_GET["nombrelista"]);





