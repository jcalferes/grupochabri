<?php

include './administracion.clases/Producto.php';
include './administracion.dao/dao.php';
$productos = new Producto();
$productos->setCodigoProducto($_GET["codigoProducto"]);
$proveedor = $_GET["proveedor"];
$dao = new dao();
$rs = $dao->buscarProducto($productos, $proveedor);
if ($rs == false) {
    echo mysql_error();
} else {
    $paso = false;
    while ($resultSet = mysql_fetch_array($rs)) {
        $paso = true;
        $arr[] = array(
            'codigoProducto' => $resultSet[0],
            'producto' => $resultSet[1],
            'costo' => $resultSet[2]
        );
        
    }
    if ($paso == false) {
        echo '1';
    } else {
        echo '' . json_encode($arr) . '';
    }
}
?>
