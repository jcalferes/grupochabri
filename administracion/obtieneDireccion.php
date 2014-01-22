<?php

include './administracion.dao/dao.php';
$dao = new dao();
$cpsotal = $_GET["postal"];
$datos = $dao->obtieneDireccion($cpsotal);

$arr = array();
while ($obj = mysql_fetch_object($datos)) {
    $arr[] = array('idcpostales' => $obj->idcpostales,
        'cp' => $obj->cp,
        'asenta' => utf8_encode($obj->asenta),
        'estado' => utf8_encode($obj->estado),
        'ciudad' => utf8_encode($obj->ciudad),
    );
}
echo '' . json_encode($arr) . '';
?>