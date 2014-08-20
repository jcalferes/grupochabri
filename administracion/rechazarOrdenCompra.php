<?php

session_start();
include './administracion.dao/dao.php';
$dao = new dao();
$idFolio = $_GET["idFolio"];
$idSucursal = $_SESSION["sucursalSesion"];
$rsFolio = $dao->dameFolioComprobante($idFolio);
if ($rsFolio == false) {
    echo mysql_error();
} else {
    $idFolioComprobante = 0;
    while ($rsFol = mysql_fetch_array($rsFolio)) {
        $idFolioComprobante = $rsFol["folioComprobante"];
    }
    $rs = $dao->eliminarOrdenCompra($idFolio, $idSucursal, $idFolioComprobante);
    if ($rs == "") {
        echo 'Orden de compra eliminado';
    } else {
        echo $rs;
    }
}