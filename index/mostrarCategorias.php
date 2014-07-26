<?php

include './index.dao/index.dao.php';
include_once '../daoconexion/daoConeccion.php';

$dao = new dao();
$cn = new coneccion();

$cn->Conectarse();
$data = $dao->mostarCategorias();
if ($data == false) {
    echo "";
} else {
    echo "<div class='list-group categories'>";
    while ($rs = mysql_fetch_array($data)) {
        echo "<a href='#' class='list-group-item'>$rs[grupoProducto] <span class='glyphicon glyphicon-chevron-right'></span></a>";
    }
    echo "</div>";
}
$cn->cerrarBd();
