<?php

session_start();
include './administracion.dao/dao.php';
$dao = new dao();
$codigo = $_GET["codigoProductoG"];
$valida = $dao->verificaProductoGranel($codigo);
echo $valida;
