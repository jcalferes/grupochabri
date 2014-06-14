<?php

session_start();
include './administracion.dao/dao.php';
include_once '../daoconexion/daoConeccion.php';

$foliocancelacion = $_GET["foliocancelacion"];
$idsucursal = $_SESSION["sucursalSesion"];
$dao = new dao();
$cn = new coneccion();

$cn->Conectarse();
$datos = $dao->dameInfoCancelacion($foliocancelacion, $idsucursal);
if ($datos != false) {
    echo "<div class='well well-sm'><table class='table'>";
    while ($rs = mysql_fetch_array($datos)) {
        echo "<tr>";
        echo "<td><label>Folio: </label>$rs[folioComprobante]<br><label>RFC del cliente: </label>$rs[rfcComprobante]</td>";
        echo "<td></tr><tr>";
        echo "<td><label>Descuento total: </label>$rs[desctTotalComprobante]</td>";
        echo "<td><label>Total: </label>$rs[totalComprobante]</td></tr>";
    }
    echo "</table></div>";
    mysql_data_seek($datos,0); 
    echo "<div class='table-responsive'><table class='table table-bordered table-condensed' id='dtcancelacion'><thead><th>Folio</th><th>RFC del cliente</th><th>Desc. Total</th><th>Total</th></thead><tbody>";
    while ($rs = mysql_fetch_array($datos)) {
        echo "<tr>";
        echo "<td>$rs[folioComprobante]</td>";
        echo "<td>$rs[rfcComprobante]</td>";
        echo "<td>$rs[desctTotalComprobante]</td>";
        echo "<td>$rs[totalComprobante]</td>";
    }
    echo "</tbody></table></div>";
} else {
    echo "<script>alertify.error('El folio no existe o no se encontraron datos para el mismo');</script>";
}

