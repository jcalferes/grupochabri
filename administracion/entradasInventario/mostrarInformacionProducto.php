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
    $interfaz .="<div id='detalle'>";
    while ($datos = mysql_fetch_array($rs)) {
        $interfaz .="<strong>Producto :</strong> " . $datos[0] . "&nbsp;";
        $interfaz .="<strong>Proveedor :</strong>" . $datos[1] . "&nbsp;";
        $interfaz .="<strong>Marca :</strong>" . $datos[2] . "<br/>";
        $info = true;
    }
    $interfaz .="</div>";
    if ($info == false) {
        $interfaz = 1;
    }
}
echo $interfaz;
?>
