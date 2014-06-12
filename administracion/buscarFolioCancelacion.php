<?php
session_start();
include './administracion.dao/dao.php';
include_once '../daoconexion/daoConeccion.php';

$foliocancelacion = $_GET["foliocancelacion"];
$idsucursal = $_SESSION["sucursalSesion"];
$dao = new dao();
$cn = new coneccion();

$cn->Conectarse();
$datos = $dao->dameInfoCancelacion($foliocancelacion,$idsucursal);
if ($datos != false) {
    echo "<div class='table-responsive'><table class='table table-hover' id='dtcancelacion'><thead><th>Nombre</th><th>RFC</th><th>Credito</th><th>Dias de Credito</th><th>Desct. Factura</th><th>Desct. Pronto Pago</th><th>Direccion</th></thead><tbody>"
    . "<tr></tr>";
} else {
    echo "ERROR: AL OBTENER DATOS";
}

