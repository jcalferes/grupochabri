<?php

include './administracion.dao/dao.php';
include './administracion.clases/Producto.php';
include './administracion.clases/Costo.php';
include './administracion.clases/Tarifa.php';
session_start();
$idsucursal = $_SESSION["sucursalSesion"];
$producto = new Producto();
$costo = new Costo();
$tarifa = new Tarifa();
$dao = new dao();
$lista = json_decode(stripslashes($_GET["lista"]));
$producto->setIdUnidadMedida($_GET["unidadMedida"]);
$producto->setCbarras($_GET["cbarras"]);
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
$granel = $_GET["granel"];
$contenido = $_GET["contenido"];
$cuantos = 1; //Solo sirve para los productos granel, indica cuanto se resta a la existencia del padre, caundo se crea un granel hijo
$original = $_GET["original"];

$datos = $dao->comprobarCodigoValido($_GET["codigoProducto"]);
if ($datos < 1) {
    $dao->guardarProducto($producto, $costo, $tarifa, $idsucursal);
    if ($granel == 1) {
        $dao->actualizaExsitenciaGranel($idsucursal, $producto, $contenido, $cuantos, $original);
    }
    echo 1;
} else {
    echo 0;
}

