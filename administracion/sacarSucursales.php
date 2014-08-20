<?php

include_once './administracion.dao/dao.php';
$dao = new dao();
session_start();
if (isset($_GET["pedidoCliente"])) {
    $validando = $_GET["pedidoCliente"];
} else {
    $sucursal = $_SESSION["sucursalSesion"];
}

$datos = $dao->consultaSucursales($sucursal);
if ($datos != false) {
    echo "<option value='0'>Seleccione una Sucursal</option>";
    while ($rs = \mysql_fetch_array($datos)) {
        echo "<option value='$rs[idSucursal]'>$rs[sucursal]</option>";
    }
} else {
    echo "<option value='0'>Seleccione una Sucursal</option>";
}