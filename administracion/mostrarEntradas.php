<?php

include './administracion.dao/dao.php';
$dao = new dao();
$datos = $dao->obtenerEntradas();
if ($datos == false) {
    echo mysql_error();
} else {
    echo '<br>';
    echo '<br>';
    echo '<table class="table table-hover">';
    echo '<tr>
        <td><strong>Producto</strong></td>
        <td><strong>Cantidad<strong></td>
      <tr>';
    while ($rs = mysql_fetch_array($datos)) {
        echo '<tr>';
        echo '<td>"' . $rs["producto"] . '"</td>';
        echo '<td>"' . $rs["cantidad"] . '"</td>';
        echo '</tr>';
    }
    echo '</table>';
}
?>
