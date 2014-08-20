<?php

include_once './administracion.dao/dao.php';
error_reporting(0);
$dao = new dao;
$arr2 = "";
$datos = $dao->comprobarCodigoValido2($_GET["codigoProducto"]);
$total = mysql_affected_rows();
if ($total > 0) {
    while ($rs = mysql_fetch_array($datos)) {
        $arr[][] = array('comprobante' => "1", 'descripcion' => $rs["descripcion"], 'idTipo' => $rs["idTipo"], 'ponerRecomendado' => $rs["ponerRecomendado"], 'ponerNovedades' => $rs["ponerNovedades"], 'idGrupoProducto' => $rs["idGrupoProducto"], 'ruta' => $rs["ruta"], 'idImagen' => $rs["idImagen"], 'grupo' => $rs["grupoProducto"], 'nombre' => $rs["producto"]);
    }
    echo json_encode($arr);
} else {
    while ($rs = mysql_fetch_array($datos)) {
        $arr[][] = array('comprobante' => "2", 'idGrupoProducto' => $rs["idGrupoProducto"]);
        $arr2 = $arr;
    }
    echo json_encode($arr2);
}