<?php

include './administracion.dao/dao.php';
$dao = new dao();
$codigo = $_GET["codigoProducto"];
$array[] = array();
$datos = $dao->comprobarCodigoValido($codigo);
if ($datos != 0) {
    $datos2 = $dao->consultandoProductoPorCodigo($codigo);
    $rs = mysql_fetch_array($datos2);

    echo ''.json_encode($rs).'';
    
} else {
    echo 0;
}