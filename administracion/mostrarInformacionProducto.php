<?php

include '../administracion/administracion.dao/dao.php';
$dao = new dao();
$codigo = $_GET["codigoProducto"];
$rs = $dao->obtenerInformacionProducto($codigo);
$interfaz = null;
if ($rs == false) {
    $interfaz = mysql_error();
} else {
    $info = false;
    $interfaz .="<div id='detalle' class='well well-lg'>";
    while ($datos = mysql_fetch_array($rs)) {
        $interfaz .="<strong>PRODUCTO:&nbsp;" . $datos[0] . "&nbsp;";
        $interfaz .="PROVEEDOR:&nbsp;" . $datos[1] . "&nbsp;";
        $interfaz .="MARCA:&nbsp; " . $datos[2] . "</strong>";
        $info = true;
    }
    $interfaz .="</div>";
    if ($info == false) {
        $interfaz = 1;
    }
}
echo $interfaz;
?>
