<?php

include '../daoconexion/daoConeccion.php';
include './administracion.dao/dao.php';
$cn = new coneccion();
$dao = new dao();
$id = $_GET["id"];
$cn->Conectarse();
$rs = $dao->dameInformacionEncabezado($id);
if ($rs == false) {
    echo mysql_error();
} else {
    $tipoPago = 0;
    $idFolio = 0;
    while ($datos = mysql_fetch_array($rs)) {
        $tipoPago = $datos["idTipoPago"];
        $idFolio = $datos["folioComprobante"];
    }
    echo $tipoPago . "," . $idFolio;
}
