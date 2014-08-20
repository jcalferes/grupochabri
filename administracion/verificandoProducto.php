<?php

session_start();
include './administracion.dao/dao.php';
$dao = new dao();
$codigo = $_GET["codigoProducto"];
$controlg = $_GET["controlg"];
$sucursal = $_SESSION["sucursalSesion"];
$array[] = array();
$datos = $dao->consultandoProductoPorCodigo($codigo, $sucursal);
if ($datos != 0) {
    $rs = mysql_fetch_array($datos);
    if ($rs == false) {
        //=================
        if ($controlg == 0) {
            $datos2 = $dao->consultandoProductoPorCodigoBarras($codigo, $sucursal);
            if ($datos2 != 0) {
                $rs = mysql_fetch_array($datos2);
                if ($rs == false) {
                    echo 0;
                } else {
                    echo '' . json_encode($rs) . '';
                }
            } else {
                echo 0;
            }
        } else {
            echo 0;
        }
        //================
    } else {
        echo '' . json_encode($rs) . '';
    }
} else {
    echo 0;
}
