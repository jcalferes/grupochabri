<?php

include './index.dao/index.dao.php';
include_once '../daoconexion/daoConeccion.php';

$dao = new dao();
$cn = new coneccion();

$id = $_GET["id"];
$nm = $_GET["nm"];

$cn->Conectarse();
$data = $dao->mostarCategorias();
$data2 = $dao->mostarSubcategorias($id);
if ($data == false) {
    echo "";
} else {
    echo "<div class='list-group categories'>";
    while ($rs = mysql_fetch_array($data)) {
        echo "<a href='categoria.php?id_grupo=$rs[idGrupoProducto]&nm_grupo=$rs[grupoProducto]' class='list-group-item'>$rs[grupoProducto]<span class='glyphicon glyphicon-chevron-right'></span></a>";
        if ($rs["idGrupoProducto"] == $id) {
            echo " <div class='list-subgroups'>";
            while ($rx = mysql_fetch_array($data2)) {
                echo "<a onclick='filtraCachibaches($rx[idTiposProducto])' class='list-subgroup-item'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$rx[TiposProducto]</a>";
            }
            echo "</div>";
        }
    }
    echo "</div>";
}
$cn->cerrarBd();
