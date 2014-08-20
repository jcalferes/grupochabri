<?php

session_start();
include './administracion.dao/dao.php';
$totalCompra = $_GET["total"];
$rfc = $_GET["cliente"];
$idSucursal = $_SESSION["sucursalSesion"];
$dao = new dao();
$datos = $dao->dameNotaCredito($idSucursal, $rfc);
if ($datos == false) {
    echo mysql_error();
} else {
    while ($rs = mysql_fetch_array($datos)) {
        echo '<center>';
        echo '<span id="idClienteNC" style="display:nonde">'.$rs["idCliente"].'</span>';
        echo'<span id="idNotasCredito">'.$rs["idNotasCredito"].'</span>';
        echo '<strong>Nombre: ' . $rs["nombre"] . '</strong> ';
        echo '<table class="table table-hover">';
        echo '<tr>';
        echo '<td>Nota de credito Disponible: </td>';
        echo '<td><label style="color:red">$' . $rs[0] . '</label></td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td>Nota de credito  en compra:</td>';
        echo '<td><label style="color:red">$' . $totalCompra . '</label></td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td>Total disponible:</td>';
        echo '<td><label style="color:red">$<span id="totalDisponibleNotaCredito">' . ($rs[0] - $totalCompra) . '</span></label></td>';
        echo '</tr>';
        echo '<table>';
        echo '</center>';
    }
}