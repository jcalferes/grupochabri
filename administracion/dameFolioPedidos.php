<?php
session_start();
$idSucursal = $_SESSION["sucursalSesion"];
include './administracion.dao/dao.php';
$dao = new dao();
$rs = $dao->dameFolioOrdenCompra($idSucursal);
while ($datos = mysql_fetch_array($rs)) {
    echo '<label style = "color: red; font-size: 15px">' . $datos[0] . '</label>';
}