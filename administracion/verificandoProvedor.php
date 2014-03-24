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
if ($prov != false) {

    while ($pdt = mysql_fetch_array($prov)) {
        $arr['proveedor']['datos'] = array('nombre' => $pdt["nombre"], 'rfc' => $pdt["rfc"], 'diascredito' => $pdt["diasCredito"], 'descuentopf' => $pdt["descuentoPorFactura"], 'descuentopp' => $pdt["descuentoPorProntoPago"], 'tipoProveedor' => $pdt["tipoProveedor"]);
    }
    while ($ddt = mysql_fetch_array($dire)) {
        $arr['direccion']['datos'] = array('calle' => $ddt["calle"], 'numeroext' => $ddt["numeroExterior"], 'numeroint' => $ddt["numeroInterior"], 'cruzamientos' => $ddt["cruzamientos"], 'postal' => $ddt["postal"], 'colonia' => $ddt["colonia"], 'ciudad' => $ddt["ciudad"], 'estado' => $ddt["estado"]);
    }
    while ($tdt = mysql_fetch_array($tele)) {
        $arr['telefonos']['datos'] = array($tdt["telefono"]);
    }
    while ($edt = mysql_fetch_array($emai)) {
        $arr['email']['datos'] = array($edt["email"]);
    }

    echo json_encode($arr);
} 
