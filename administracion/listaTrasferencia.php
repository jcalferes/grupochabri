<?php
include './administracion.clases/transaccionDetalles.php';
include './administracion.clases/transaccionEncabezados.php';
include './administracion.dao/dao.php';
session_start();
$idsucursal= $_GET["idSucursal"];
$codigo = $_GET["codigo"];
$dao = new dao();
$datos = $dao -> buscarCodigo($codigo, $idsucursal);
$validar = mysql_affected_rows();
if ($validar > 0) {

    while ($datosProducto = mysql_fetch_array($datos)) {
        $arr[][] = array('cantidad' => $datosProducto["cantidad"], 'costo' => $datosProducto["costo"], 'producto' => $datosProducto["producto"], 'codigoProducto' => $datosProducto["codigoProducto"]);
    }
    
    echo json_encode($arr);
}  else{
    echo '0';
    
}


