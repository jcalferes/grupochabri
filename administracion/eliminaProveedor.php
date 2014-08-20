<?php
include './administracion.dao/dao.php';


$dao = new dao();
$lista = json_decode(stripslashes($_GET["proveedor"]));
$dao->eliminaProveedor($lista);