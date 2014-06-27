<?php

session_start();
include './administracion.clases/Proveedor.php';
include './administracion.clases/Direccion.php';
include_once '../daoconexion/daoConeccion.php';
include './administracion.clases/Usuario.php';
include '../utileriasPhp/Utilerias.php';
include './administracion.dao/dao.php';
error_reporting(0);
$proveedor = new Proveedor();
$direccion = new Direccion();
$usuario = new Usuario();
$utilerias = new Utilerias();
$cn = new coneccion();
$dao = new dao();

$idsucursal = $_SESSION["sucursalSesion"];

$datos = json_decode($_POST['datos']);

$prov = $datos[0];
$dire = $datos[1];
$telefonos = $datos[2];
$emails = $datos[3];

$proveedor->setTipoProveedor($prov->radios);
$proveedor->setNombre($prov->nombre);
$proveedor->setRfc($prov->rfc);
$proveedor->setCredito($prov->credito);
$proveedor->setDiasCredito($prov->diascredito);
$proveedor->setDesctfactura($prov->desctpf);
$proveedor->setDesctprontopago($prov->desctpp);


$usuario->setTipousuario(7);
$usuario->setNombre($prov->nombre);
$usuario->setPaterno("NA");
$usuario->setMaterno("NA");
$usuario->setUsuario($prov->user);
$usuario->setPass($utilerias->genera_md5($prov->pass));

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
$control = $dao->superGuardadorClientes($proveedor, $direccion, $telefonos, $emails, $ctrltelefonos, $ctrlemails, $usuario, $idsucursal);
$cn->cerrarBd();

if ($control === false) {
    echo 1;
}
if ($control === true) {
    echo 0;
}
if ($control === 999) {
    echo 999;
} 
if ($control === 777) {
    echo 777;
}




