<?php

include './administracion.dao/dao.php';
$dao = new dao();
$usuario = $_GET["usuario"];
$datos = $dao->consultarExistenciaUsuario($usuario);
if ($datos != 0) {
    $rs = mysql_fetch_array($datos);
    echo '' . json_encode($rs) . '';
} else {
    echo 0;
}

