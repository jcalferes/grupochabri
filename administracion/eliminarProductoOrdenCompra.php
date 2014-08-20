<?php 

session_start();
include './administracion.dao/dao.php';
$dao = new dao();
$codigo = $_GET["codigo"];
$idXmlComprobante = $_GET["idComprobante"];
$idsucursal = $_SESSION["sucursalSesion"];
$arrayEncabezado = json_decode($_GET["array"]);
//$datos = $arrayEncabezado[0]->subTotalComprobante;
$error = $dao->eliminarProductoOredenCompra($codigo, $idXmlComprobante, $idsucursal, $arrayEncabezado);
if ($error == "") {
    echo "Producto eliminado";
} else {
    echo $error;
}