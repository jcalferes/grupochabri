<?php

include './administracion.dao/dao.php';
$dao = new dao();
$idXmlComprobante = $_GET["id"];
$rs = $dao->dameOrdenCompraDetalle($idXmlComprobante);
if ($rs == false) {
    echo mysql_error();
} else {
    echo '<table>';
    echo '<thead>';
    echo '<th>Codigo</th>';
    echo '<th>Descripcion</th>';
    echo '<th>Cantidad</th>';
    echo '<th>Existencia</th>';
    echo '<th>Lst. Precio</th>';
    echo '<th>Precio c/u</th>';
    echo '<th>Desc</th>';
    echo '<th>Eliminar</th>';
    echo '<th>total</th>';
    echo '<th>$ Desc.</th>';
    echo '<th>Total c/d.</th>';
    echo '</thead>';
    while ($datos = mysql_fetch_array($rs)) {
        echo '<tr>';
        echo '<td>';
        echo $datos["codigoConcepto"];
        echo '</td>';
        echo '<td>';
        echo $datos["descripcionConcepto"];
        echo '</td>';
        echo '<td>';
        echo $datos["codigoConcepto"];
        echo '</td>';
        echo '<td>';
        echo $datos["codigoConcepto"];
        echo '</td>';
        echo '<td>';
        echo $datos["codigoConcepto"];
        echo '</td>';
        echo '<td>';
        echo $datos["codigoConcepto"];
        echo '</td>';
        echo '<td>';
        echo $datos["codigoConcepto"];
        echo '</td>';
        echo '<td>';
        echo $datos["codigoConcepto"];
        echo '</td>';
        echo '<td>';
        echo $datos["codigoConcepto"];
        echo '</td>';
        echo '<td>';
        echo $datos["codigoConcepto"];
        echo '</td>';
        echo '<td>';
        echo $datos["codigoConcepto"];
        echo '</td>';
        echo '</tr>';
    }
    echo '</table>';
}
