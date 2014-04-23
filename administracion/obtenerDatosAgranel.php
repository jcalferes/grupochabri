<?php

include './administracion.dao/dao.php';
$dao = new dao();
$codigo = $_GET["codigoProducto"];
$rs = $dao->obtenerDatosAgranel($codigo);
if ($rs == false) {
    echo 0;
} else {
    while ($datos = mysql_fetch_array($rs)) {
        $cantidad = $datos["cantidad"];
    }
    echo $cantidad;
}


