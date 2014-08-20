<?php
include './administracion.dao/dao.php';
$dao = new dao();
$producto = $_GET["producto"];
$resultado = $dao->consultaExistencia($producto);
 if (mysql_affected_rows() == 0) {
            $cantidad = 0;
        } else {
            while ($rs = mysql_fetch_array($resultado)) {
                $cantidad = $rs["cantidad"];
            }
        }

       
echo $cantidad;
