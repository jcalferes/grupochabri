<?php

include './administracion.dao/dao.php';
include './administracion.clases/Producto.php';
include './administracion.clases/Costo.php';
include './administracion.clases/Tarifa.php';
$producto = new Producto();
$costo = new Costo();
$tarifa = new Tarifa();
$dao = new dao();
$lista = json_decode(stripslashes($_GET["lista"]));
$producto->setIdUnidadMedida($_GET["unidadMedida"]);
$producto->setIdGrupoProducto($_GET["grupoProducto"]);
$producto->setCantidadMaxima($_GET["max"]);
$producto->setCantidadMinima($_GET["min"]);
$producto->setProducto($_GET["producto"]);
$producto->setIdMarca($_GET["marca"]);
$producto->setIdProveedor($_GET["proveedor"]);
$producto->setCodigoProducto($_GET["codigoProducto"]);
$costo->setCosto($_GET["costoProducto"]);
//$costo->setFolioProducto($_GET["folio"]);
$tarifa->setIdListaPrecio($lista);

$datos = $dao->comprobarCodigoValido($producto);
if($datos < 1){
$dao->guardarProducto($producto, $costo, $tarifa);
echo 1;

}else{
   echo 0;
}
