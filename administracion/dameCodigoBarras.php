<?php

include './administracion.dao/dao.php';
$dao = new dao();
$codigo = $_GET["codigo"];
$rs = $dao->dameCodigo($codigo);
if ($rs == false) {
    echo '-1';
} else {
    $codigo = 0;
    while ($datos = mysql_fetch_array($rs)) {
        $codigo = $datos[0];
        break;
    }
    echo $codigo;
}
?>