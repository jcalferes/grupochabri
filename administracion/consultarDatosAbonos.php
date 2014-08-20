<?php

include_once '../daoconexion/daoConeccion.php';
include './administracion.dao/dao.php';
$cn = new coneccion();
$dao = new dao();
$folio = $_GET["folio"];
$sucursal = 1;
$cn->Conectarse();
$arr[] = 0;
$bandera = false;
$datos = $dao->consultarDatosAbonos($folio, $sucursal);
while ($pdt = mysql_fetch_array($datos)) {
    $bandera = true;
    $arr['cliente'] = array('nombre' => $pdt["nombre"], 'rfc' => $pdt["rfc"], 'credito' => $pdt["credito"], 'totalComprobante' => $pdt["totalComprobante"]);
}
if ($bandera == true) {
    echo json_encode($arr);
} else {
    echo 0;
}

