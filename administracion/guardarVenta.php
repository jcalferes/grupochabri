<?php

session_start();
include '../daoconexion/daoConeccion.php';
include './administracion.dao/dao.php';
include './administracion.clases/Encabezado.php';
$en = new Encabezado();
$idSucursal = $_SESSION["sucursalSesion"];
$usuario = $_SESSION["usuarioSesion"];
$dao = new dao();
$datos = json_decode(stripslashes($_POST['data']));
$encabezado = $datos[0];
$detalle = $datos[1];
$idStatus = $encabezado[0]->tipoComprobante;
if ($idStatus == 1) {
    $idStatusOrden = 7;
} else {
    $idStatusOrden = 5;
}
$rs = $dao->dameFolio();
while ($datos = mysql_fetch_array($rs)) {
    $folio = $rs[0];
}
$error = $dao->guardarventas($encabezado, $detalle, $idSucursal, $usuario, $idStatusOrden, $folio);
if ($error == "") {
    $error = 0;
}
echo $error;
