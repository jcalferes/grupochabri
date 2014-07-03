<?php

include_once './administracion.dao/dao.php';
$dao = new dao;
$datos = $dao->comprobarCodigoValido2($_GET["codigoProducto"]);
$total = mysql_affected_rows();
if ($total > 0) {
    while ($rs = mysql_fetch_array($datos)) {
        $arr[][] = array('descripcion' => $rs["descripcion"], 'idTipo' => $rs["idTipo"], 'ponerRecomendado' => $rs["ponerRecomendado"], 'ponerNovedades' => $rs["ponerNovedades"], 'idGrupoProducto' => $rs["idGrupoProducto"]);

        echo json_encode($arr);
    }
} else {
    while ($rs = mysql_fetch_array($datos)) {

        $arr[][] = array('idGrupoProducto' => $rs["idGrupoProducto"]);
        $arr2 = $arr;
        echo json_encode($arr2);
    }
}