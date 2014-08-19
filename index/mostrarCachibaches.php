<?php

include './index.dao/index.dao.php';
include_once '../daoconexion/daoConeccion.php';

$dao = new dao();
$cn = new coneccion();

$id = $_GET["id"];
$nm = $_GET["nm"];

$contador = 0;
$pagina = 0;
$bandera = true;
$limite = 0;

$cn->Conectarse();
$data = $dao->mostarCachibaches($id, $nm);
if ($data != false) {
    $row = $data[0];
    $datos = $data[1];

    echo "<div class='col-lg-12'>";
    echo "<table class='table table-hover' id='tbCachibaches'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th></th>";
    echo "</tr>";
    echo"</thead>";
    echo "<tbody>";
    while ($rs = mysql_fetch_array($datos)) {
//        if ($pagina < 1) {
//            echo "<tr  class='cachibaches pag$pagina'>";
//        } else {
//            echo "<tr  class='cachibaches pag$pagina' style='display: none;'>";
//        }

        echo "<td class='col-sm-8 col-md-6'>";
        echo "<div class='media'>";

        echo "<a class='thumbnail pull-left' href='#'>";
        echo "<img class='media-object' src='../subidas/$rs[ruta]' style='width: 72px; height: 72px;' />";
        echo "</a>";

        echo "<div class='media-body'>";
        echo "<h5 class='media-heading'><a href='detalles.php?code_prod=$rs[codigoProducto]'>$rs[producto]</a></h5>";
        echo "<p><small>$rs[codigoProducto]</small></p>";

        $exist = $dao->existenciaCachibache($rs["codigoProducto"]);
        echo "<table><td><small>Existencias:</small></td><tr>";
        while ($rx = mysql_fetch_array($exist)) {
            echo "<td><small>" . ucwords(strtolower($rx["sucursal"])) . ":&nbsp&nbsp</small></td><td><small>$rx[cantidad]&nbsp&nbsp&nbsp</small></td>";
        }
        echo "</tr></table>";

        echo "</div>";

        echo "</div>";
        echo "</td>";
        echo "</tr>";
        $undato = $rs["codigoProducto"];

//        $bandera = false;
//        $contador++;
//        $limite++;
//        if ($contador == 4 || $limite == $row) {
//
//            $bandera = true;
//            $pagina++;
//            $contador = 0;
//        }
    }
    echo "</tbody>";
    echo "</table>";

//    echo "<div class='col-lg-12' style='text-align: center'>";
//    echo "<ul class='pagination'>";
//    for ($i = 1; $i <= $pagina; $i++) {
//        echo "<li><a onclick='mostrarPagina($i)'>$i</a></li>";
//    }
//    echo "</ul>";
//    echo "</div>";

    echo "</div>";
    echo "<script>";
}
