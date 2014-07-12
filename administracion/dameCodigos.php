<?php

include './administracion.dao/dao.php';
$dao = new dao();
$idXml = $_GET["id"];
$datos = $dao->dameCodigosProductosOrdenCompra($idXml);
if ($dao == false) {
    echo mysql_error();
} else {
//    $array = 0;
    while ($rs = mysql_fetch_array($datos)) {
        $arr[] = array(
            'codigoProducto' => $rs["codigoConcepto"]);
    }

    echo json_encode($arr);
}