<?php

session_start();
include '../daoconexion/daoConeccion.php';
include './administracion.dao/dao.php';
include './administracion.clases/Encabezado.php';
$en = new Encabezado();
$error = "";
$idSucursal = $_SESSION["sucursalSesion"];
$usuario = $_SESSION["usuarioSesion"];
$dao = new dao();
$datos = json_decode(stripslashes($_POST['data']));
$encabezado = $datos[1];
$detalle = $datos[0];
$idStatus = $encabezado[0]->tipoComprobante;
$abonos = false;
$idStatusOrden = 5;
$rs = $dao->dameFolioOrdenCompra($idSucursal);
while ($datos = mysql_fetch_array($rs)) {
    $folio = $datos[0];
}
$error = $dao->guardarventas($encabezado, $detalle, $idSucursal, $usuario, $idStatusOrden, $folio, $abonos);
if ($error == "") {
    $error = 0;
}
echo $error;
