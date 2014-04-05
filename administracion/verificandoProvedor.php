<?php

include_once '../daoconexion/daoConeccion.php';
include './administracion.dao/dao.php';
$cn = new coneccion();
$dao = new dao();
$rfc = $_GET["rfc"];
$cn->Conectarse();
$prov = $dao->puleaProveedor($rfc);
$dire = $dao->puleaDireccion($rfc);
$tele = $dao->puleaTelefono($rfc);
$emai = $dao->puleaEmails($rfc);

//$telefonos = [];
$conttel = 0;

//$emails = [];
$contema = 0;
if ($prov != false) {
    while ($pdt = mysql_fetch_array($prov)) {
        $arr['proveedor']['datos'] = array('nombre' => $pdt["nombre"], 'rfc' => $pdt["rfc"], 'diascredito' => $pdt["diasCredito"], 'descuentopf' => $pdt["descuentoPorFactura"], 'descuentopp' => $pdt["descuentoPorProntoPago"], 'tipoproveedor' => $pdt["tipoProveedor"]);
    }
    while ($ddt = mysql_fetch_array($dire)) {
        $arr['direccion']['datos'] = array('calle' => $ddt["calle"], 'numeroext' => $ddt["numeroExterior"], 'numeroint' => $ddt["numeroInterior"], 'cruzamientos' => $ddt["cruzamientos"], 'postal' => $ddt["postal"], 'colonia' => $ddt["colonia"], 'ciudad' => $ddt["ciudad"], 'estado' => $ddt["estado"]);
    }
    while ($tdt = mysql_fetch_array($tele)) {
        $telefonos[$conttel] = $tdt;
        $conttel++;
    }
    $arr['telefonos']['datos'] = $telefonos;
    while ($edt = mysql_fetch_array($emai)) {
        $emails[$contema] = $edt;
        $contema++;
    }
    $arr['emails']['datos'] = $emails;
    echo json_encode($arr);
} else {
    echo 0;
}
