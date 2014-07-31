<?php

include './index.dao/index.dao.php';
include_once '../daoconexion/daoConeccion.php';

$dao = new dao();
$cn = new coneccion();

$conta = 0;
$max = 8;

$cn->Conectarse();
$data = $dao->mostarRecomendados();
if ($data == false) {
    echo "";
} else {
//    echo "<div class='row selected-classifieds'>";
    while ($rs = mysql_fetch_array($data)) {
        if ($conta < $max) {
            echo "<div class='col-lg-3'>";
            echo "<div class='thumbnail'>";
            echo "<img src='../subidas/$rs[ruta]' />";
            echo "<div class='caption' style='height:100px'>";
            echo "<p><span style='font-size:75%'><a href='detalles.php?code_prod=$rs[codigoProducto]'>$rs[producto]</a></span><p>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
            $conta++;
        } else {
            break;
        }
    }
//    echo "</div>";
}
$cn->cerrarBd();
