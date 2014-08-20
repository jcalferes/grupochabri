<?php

session_start();
include './administracion.dao/dao.php';
$dao = new dao();
$codigo = $_GET["codigoProducto"];
$sucursal = $_SESSION["sucursalSesion"];
$x = explode('-', $codigo);
$codigopapa = $x[0];
$dgran = $dao->obtenerDatosAgranel($codigo, $codigopapa, $sucursal);
if ($dgran == false) {
    echo 0;
} else {
    while ($rs = mysql_fetch_array($dgran)) {
        $arr['granel']['datos'] = array('contenido' => $rs["cantidad"], 'costo' => $rs["costo"]);
    }
    echo  json_encode($arr);
}


