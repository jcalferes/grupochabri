<?php

include './administracion.dao/dao.php';
$dao = new dao();
$datos = $dao->consultaProducto();
$valor = '/\sSi\s/';
$valor2 = '%20';
while ($rs = mysql_fetch_array($datos)) {
    $palabra = preg_replace($valor, $valor2, $rs[0]);
    echo'<option value=' . $palabra . '>  </option>';
}