<?php

include './administracion.dao/dao.php';
$dao = new dao();
$codigo = $_GET["codigoProducto"];
$array = array();
$datos = $dao->mostrarTarifasTabla($codigo);
while ($rs = mysql_fetch_array($datos)) {

    $array[] = $rs;

}
    echo json_encode($array);
    

