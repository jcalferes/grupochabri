<?php

include './index.dao/index.dao.php';
include_once '../daoconexion/daoConeccion.php';

$dao = new dao();
$cn = new coneccion();

$cn->Conectarse();
$data = $dao->mostarNovedades();

$conta = 0;
$max = 4;

if ($data == false) {
    echo "";
} else {
    echo "<div class='newest-classifieds'>";
    while ($rs = mysql_fetch_array($data)) {
        if ($conta < $max) {
            echo "<div class='media'>";
            echo "<a class='pull-left' href='#'>";
            echo "<img class='media-object' style='width: 64px; height: 64px;' src='../subidas/$rs[ruta]'/>";
            echo "</a>";
            echo "<div class='media-body'>";
            echo "<p><a href='#'><strong>$rs[producto]</strong></a></p>";
            echo "<p>$rs[descripcion]</p>";
            echo "</div>";
            echo "</div>";
            $conta++;
        } else {
            break;
        }
    }
    echo "</div>";
}
$cn->cerrarBd();

