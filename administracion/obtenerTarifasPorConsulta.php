<?php
session_start();
include './administracion.dao/dao.php';

$idsucursal= $_SESSION["sucursalSesion"];
$dao = new dao();
$codigo = $_GET["codigoProducto"];
$array = array();
$datos = $dao->mostrarTarifasTabla($codigo,$idsucursal);
while ($rs = mysql_fetch_array($datos)) {

    $array[] = $rs;

}
    echo json_encode($array);
    

