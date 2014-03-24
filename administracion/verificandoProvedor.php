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
        $arr['proveedor']['datos'] = array('nombre' => $pdt["nombre"], 'rfc' => $pdt["rfc"], 'diascredito' => $pdt["diasCredito"]);
    }
    while($ddt = mysql_fetch_array($dire)){
        $arr['direccion']['datos'] = array('nombre' => $edt["nombre"], 'rfc' => $edt["rfc"], 'diascredito' => $edt["diasCredito"]);
    }
    while($tdt = mysql_fetch_array($tele)){
        $arr['telefonos']['datos'] = array('nombre' => $tdt["nombre"], 'rfc' => $pdt["rfc"], 'diascredito' => $pdt["diasCredito"]);
    }
    while($edt = mysql_fetch_array($emai)){
        $arr['telefonos']['datos'] = array('nombre' => $pdt["nombre"], 'rfc' => $pdt["rfc"], 'diascredito' => $pdt["diasCredito"]);
    }
} 




//
//while ($pdt = mysql_fetch_array($prov)) {
//    $arr['proveedor']['datos'] = array('nombre' => $pdt["nombre"], 'rfc' => $pdt["rfc"], 'diascredito' => $pdt["diasCredito"]);
//}
//echo 'asdasd';


//$datos = $dao->verificandoProveedor($rfc);
//if ($datos == 0) {
//    echo "1";
//} else {
//    $rs = mysql_fetch_array($datos, MYSQL_ASSOC);
//    foreach ($rs as $campo => $value) {
//        $array[$campo] = utf8_encode($value);
//    }
//
//    echo '' . json_encode($array) . '';
//}