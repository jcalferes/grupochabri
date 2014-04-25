<?php

session_start();
include './administracion.dao/dao.php';
include_once '../daoconexion/daoConeccion.php';

$cn = new coneccion();
$dao = new dao();

$codigo = $_GET["codigo"];
$codigog = $_GET["codigog"];
$sucursal = $_SESSION["sucursalSesion"];

$cn->Conectarse();
$validadPG = $dao->verificaProductoGranel($codigog, $sucursal);
$validaP = $dao->verificaProductoPadre($codigo, $sucursal);

if ($validadPG !== false) {
    while ($pg = mysql_fetch_array($validadPG)) {
        $arr['granel']['datos'] = array('producto' => $pg["producto"], 'cantidad' => $pg["cantidad"], 'contenido' => $pg["contenido"]);
    }
    while ($pp = mysql_fetch_array($validaP)) {
        $arr['producto']['datos'] = array('producto' => $pp["producto"], 'cantidad' => $pp["cantidad"]);
    }
    echo json_encode($arr);
} else {
    echo 0;
}
