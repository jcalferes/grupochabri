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
    echo "<table class='table'>";
    while ($rs = mysql_fetch_array($datos)) {
        echo "<tr>";
        echo "<td><label>Folio: </label><span id='spnfolio'>$rs[folioComprobante]</span><br><label>RFC del cliente: </label>$rs[rfcComprobante]</td>";
        echo "<td></tr><tr>";
        echo "<td><label>Descuento total: </label>$rs[desctTotalComprobante]</td>";
        echo "<td><label>Total: </label>$rs[totalComprobante]</td></tr>";
    }
    echo "</table>";
    mysql_data_seek($datos, 0);
    echo "<div class='well well-sm'><div class='table-responsive'><table class='table table-hover table-condensed' id='dtcancelacion'><thead><th>Codigo</th><th>Descripcion</th><th>Cantidad</th><th>Importe</th></thead><tbody>";
    while ($rs = mysql_fetch_array($datos)) {
        echo "<tr>";
        echo "<td>$rs[codigoConcepto]</td>";
        echo "<td>$rs[descripcionConcepto]</td>";
        echo "<td>$rs[cantidadConcepto]</td>";
        echo "<td>$rs[importeConcepto]</td>";
    }
    echo "</tbody></table></div></div>"
    . "<label>Observaciones:</label><br/><textarea class='form-control' id='txaobscancelacion'></textarea><br>";
    echo "<script> $('#divfoliocancelacion').slideUp(); $('#divvalidacancelacion').slideDown();</script>";
} else {
    echo "<script> alertify.error('El folio no existe o no se encontraron datos para el mismo');</script>";
}
