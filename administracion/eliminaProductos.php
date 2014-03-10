<?php
include './administracion.dao/dao.php';


$dao = new dao();
$lista = json_decode(stripslashes($_GET["productos"]));
$dao->eliminaProductos($lista);