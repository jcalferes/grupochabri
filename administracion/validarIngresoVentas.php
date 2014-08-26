<?php

session_start();
include './administracion.dao/dao.php';
$dao = new dao();
$idSucursal = $_SESSION["sucursalSesion"];
$rs = $dao->validar($idSucursal);
$respuesta = "";
if ($rs == false) {
    $respuesta = mysql_error();
} else {
    $respuesta = mysql_affected_rows();
    if ($respuesta > 0) {
        $rsDatos = $dao->validarCierreCaja($idSucursal);
        if ($rsDatos == false) {
            echo mysql_error();
        } else {
            $afect = mysql_affected_rows();
            if ($afect > 0) {
                $respuesta = 1;
            } else {
                $respuesta = 2;
            }
        }
    } else {
        $respuesta = 0;
    }
}
echo $respuesta;




