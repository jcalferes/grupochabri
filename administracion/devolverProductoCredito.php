<?php

session_start();
$idSucursal = $_SESSION["sucursalSesion"];
include './administracion.dao/dao.php';
$dao = new dao();
$datos = json_decode(stripslashes($_POST['data']));
$error = $dao->devolverPedidosCredito($datos, $idSucursal);
if ($error == "") {
    echo "EXITO DEVOLUCION CONCLUIDA";
} else {
    echo $error;
}