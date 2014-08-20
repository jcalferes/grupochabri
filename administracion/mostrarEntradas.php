<?php

session_start();
include './administracion.dao/dao.php';
$dao = new dao();
$idsucursal = 0;
$datos = $dao->obtenerEntradas($_SESSION["sucursalSesion"]);
if ($datos == false) {
    echo mysql_error();
} else {
    echo '<table class="table table-hover">';
    echo '<thead>
            <th><strong>Codigo</strong></th>
            <th><strong>Producto</strong></th>
            <th><strong>Cantidad<strong></th>
          </thead>
          <tbody>';
    while ($rs = mysql_fetch_array($datos)) {
        echo '<tr>';
        echo '<td>' . $rs["codigoProducto"] . '</td>';
        echo '<td>' . $rs["producto"] . '</td>';
        echo '<td>' . $rs["cantidad"] . '</td>';
        echo '</tr>';
    }
    echo '</tbody></table>';
}
?>
