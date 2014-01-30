<?php
include './administracion.dao/dao.php';
$dao = new dao();
$producto = $_GET["producto"];
$existencia = $dao->consultaExistencia($producto);
echo $existencia;
