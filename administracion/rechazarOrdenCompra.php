<?php

session_start();
include './administracion.dao/dao.php';
$dao = new dao();
$idFolio = $_GET["idFolio"];
$idSucursal = $_SESSION["sucursalSesion"];
$rs = $dao->eliminarOrdenCompra($idFolio, $idSucursal);
if ($rs == false) {
    echo mysql_error();
} else {
    echo 'Orden de compra eliminado';
}