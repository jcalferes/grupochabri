<?php

session_start();
include_once './administracion.dao/dao.php';
$dao = new dao;

$datos = $dao->buscarImagenes($_GET["cp"]);
$total = mysql_affected_rows();
while ($rs = mysql_fetch_array($datos)) {
         $arr[][] = array('comprobante' => "1",'ruta' => $rs["ruta"], 'idImagen' => $rs["idImagen"]);

}

echo json_encode($arr);