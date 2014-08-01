<?php

include './index.dao/index.dao.php';
include_once '../daoconexion/daoConeccion.php';

$dao = new dao();
$cn = new coneccion();

$codigo = $_GET["codigo"];

$cn->Conectarse();
$data = $dao->mostrarDetalles($codigo);
$dt = $data[0];
$img = $data[1];

$conter = 0;

if ($data == false) {
    echo "";
} else {
    echo "<div class='col-lg-9 content-right'>";
    while ($rs = mysql_fetch_array($dt)) {
        echo "<h4>$rs[producto]</h4>";
        echo "<div class='row'>";
            echo "<div class='col-md-8'>";
                echo "<div class='row'>";
                    echo "<div class='col-md-12' id='slider'>";
                        echo "<div class='col-md-12' id='carousel-bounding-box' style='padding: 0;'>";
                            echo "<div id='detailCarousel' class='carousel slide'>";
                                echo "<div class='carousel-inner'>";
                                    while ($rx = mysql_fetch_array($img)) {
                                        if($conter == 0){
                                            echo "<div class = 'active item' data-slide-number = '$conter'>";
                                        }else{
                                            echo "<div class = 'item' data-slide-number = '$conter'>";
                                        }
                                            echo "<img src = '../subidas/$rx[ruta]' class = 'img-responsive' />";
                                        echo "</div>";
                                        $conter++;
                                    }
                                    $conter = 0;
                                    mysql_data_seek($img, 0);
                                echo "</div>";
                                echo "<a class='carousel-control left' href='#detailCarousel' data-slide='prev'><span class='glyphicon glyphicon-chevron-left'></span></a>";
                                echo "<a class='carousel-control right' href='#detailCarousel' data-slide='next'><span class='glyphicon glyphicon-chevron-right'></span></a>";
                            echo "</div>";
                        echo "</div>";
                    echo "</div>";
                echo "</div>";
                echo "<div class='row'>";
                    echo "<div class='col-md-12 hidden-sm hidden-xs' id='slider-thumbs'>";
                    echo "<ul class='list-inline'>";
                    while ($rx = mysql_fetch_array($img)) {
                        echo "<li><a id='carousel-selector-$conter' class='selected'><img src='../subidas/$rx[ruta]' class='img-responsive' /></a></li>";
                        $conter++;
                    }
                    echo "</ul>";
                    echo "</div>";
                echo "</div>";
            echo "</div>";
            echo "<div class='col-md-4'>";
                echo "<table class='table table-condensed table-hover'>";
                echo "<thead>";
                echo "<th colspan='2'>Detalles:</th>";
                echo "</thead>";
                echo "<tbody style='font-size: 12px;'>";
                echo "<tr>";
                echo "<td>Codigo</td>";
                echo "<td>$rs[codigoProducto]</td>";
                echo "</tr>";
                echo "<tr>";
                echo "<td>Marca</td>";
                echo "<td>$rs[marca]</td>";
                echo "</tr>";
                echo "</tbody>";
                echo "</table>";
            echo "</div>";
        echo "</div>";
        echo "<div class='row'>";
            echo "<div class=col-md-12'>";
                echo "<h4>Description</h4>";
                echo "<p style='text-align: justify;'>$rs[descripcion]</p>";
            echo "</div>";
        echo "</div>";
    }
    echo "</div>";
}
$cn->cerrarBd();
