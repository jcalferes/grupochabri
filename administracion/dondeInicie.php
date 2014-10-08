<?php

session_start();
include_once './administracion.dao/dao.php';
include_once '../daoconexion/daoConeccion.php';
$dao = new dao();
$cn = new coneccion();
if (isset($_SESSION["sucursalSesion"])) {
    $idsucursal = $_SESSION["sucursalSesion"];
    $idusuario = $_SESSION["usuarioSesion"];
    $cn->Conectarse();
    $rs = $dao->dondeInicie($idsucursal, $idusuario);
    if (!is_resource($rs)) {
        echo $rs;
    } else {
        while ($datos = mysql_fetch_array($rs)) {
            $arr["donde"] = array('sucursal' => $datos["sucursal"], 'nombre' => ucwords(strtolower($datos["nombre"])));
        }
        echo json_encode($arr);
    }
    $cn->cerrarBd();
} else {
    echo 999;
}





