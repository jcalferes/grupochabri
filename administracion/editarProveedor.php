<?php

include './administracion.clases/Proveedor.php';
include './administracion.clases/Direccion.php';
include './administracion.dao/dao.php';
include_once '../daoconexion/daoConeccion.php';

$proveedor = new Proveedor();
$direccion = new Direccion();
$cn = new coneccion();
$dao = new dao();

$datos = json_decode($_POST['datos']);

$prov = $datos[0];
$dire = $datos[1];
$telefonos = $datos[2];
$emails = $datos[3];

$proveedor->setTipoProveedor($prov->radios);
$proveedor->setNombre($prov->nombre);
$proveedor->setRfc($prov->rfc);
$proveedor->setDiasCredito($prov->diascredito);
$proveedor->setDesctfactura($prov->desctpf);
$proveedor->setDesctprontopago($prov->desctpp);

$direccion->setCalle($dire->calle);
$direccion->setNumeroexterior($dire->numeroexterior);
$direccion->setNumerointerior($dire->numerointerior);
$direccion->setCruzamientos($dire->cruzamientos);
$direccion->setPostal($dire->postal);
$direccion->setColonia($dire->colonia);
$direccion->setCiudad($dire->ciudad);
$direccion->setEstado($dire->estado);

$ctrltelefonos = count($telefonos);
$ctrlemails = count($emails);

$cn->Conectarse();
$dao->superEditorProveedores($proveedor, $direccion, $telefonos, $emails, $ctrltelefonos, $ctrlemails);
$cn->cerrarBd();

if ($dao == true) {
    echo 0;
} else {
    echo 1;
}
