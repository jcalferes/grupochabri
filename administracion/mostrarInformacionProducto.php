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
        $interfaz .="Nombre del Producto : " . $datos[0] . "<br/>";
        $interfaz .="Nombre del Proveedor :" . $datos[1] . "<br/>";
        $interfaz .="Marca : " . $datos[2] . "<br/>";
        $info = true;
    }
    $interfaz .="</div>";
    if ($info == false) {
        $interfaz = 1;
    }
}
echo $interfaz;
?>
