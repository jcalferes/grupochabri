<?php

include_once '../daoconexion/daoConeccion.php';
include './administracion.dao/dao.php';
$cn = new coneccion();
$dao = new dao();
$folio = $_GET["folio"];
$sucursal = 1;
$cn->Conectarse();
$datos = $dao->consultarDatosAbonos($folio, $sucursal);
if ($datos != 1) {
    while ($pdt = mysql_fetch_array($datos)) {
        $arr['cliente'] = array('nombre' => $pdt["nombre"], 'rfc' => $pdt["rfc"], 'credito' => $pdt["credito"], 'totalComprobante' => $pdt["totalComprobante"]);
    }
    echo json_encode($arr);
} else {
    echo 0;
}
