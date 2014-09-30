<?php

session_start();
include './administracion.dao/dao.php';
include_once '../daoconexion/daoConeccion.php';
$dao = new dao();
$cn = new coneccion();
if (isset($_SESSION["sucursalSesion"])) {
    $idsucursal = $_SESSION["sucursalSesion"];
    $idusuario = $_SESSION["usuarioSesion"];
    $cn->Conectarse();
    $rs = $dao->dondeInicie($idsucursal, $idusuario);
    while ($datos = mysql_fetch_array($rs)) {
        $data["data"] = array('sucursal' => $datos["sucursal"], 'nombre' => ucwords(strtolower($datos["nombre"])));
    }
    echo json_encode($data);
    $cn->cerrarBd();
} else {
    echo 999;
}





