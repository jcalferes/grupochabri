<?php
session_start();
$idSucursal = $_SESSION["sucursalSesion"];
include './administracion.dao/dao.php';
$dao = new dao();
$rs = $dao->dameFolioOrdenCompra($idSucursal);
if($rs == true){
while ($datos = mysql_fetch_array($rs)) {
    echo '<label style = "color: red; font-size: 15px">' . $datos["folio"] . '</label>';
}
}
else{
    echo mysql_error();
}