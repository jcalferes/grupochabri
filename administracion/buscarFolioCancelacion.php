<?php

session_start();
include './administracion.dao/dao.php';
include_once '../daoconexion/daoConeccion.php';

$foliocancelacion = $_GET["foliocancelacion"];
$idsucursal = $_SESSION["sucursalSesion"];
$dao = new dao();
$cn = new coneccion();

$publico = 0;

$cn->Conectarse();
$datos = $dao->dameInfoCancelacionVenta($foliocancelacion, $idsucursal);
if ($datos != false) {
    echo "<table class='table'>";
    while ($rs = mysql_fetch_array($datos)) {
        echo "<tr>";
        echo "<td><label>Folio: </label><span id='spnfolio'>$rs[folioComprobante]</span><br><label>RFC del cliente: </label>$rs[rfcComprobante]";
        echo "<br><label>Nombre del cliente: </label>$rs[nombreCliente]</td>";
        if ($rs["rfcComprobante"] == "0") {
            $publico = 1;
        }
        echo "<td></tr><tr>";
        echo "<td><label>Descuento total: </label>$rs[desctTotalComprobante]</td>";
        echo "<td><label>Total: </label>$rs[totalComprobante]</td></tr>";
        break;
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
    . "<div class='form-group'><div class='checkbox'><label><input type='checkbox' id='chkreutilizar'>Reeutilizar como una venta</label></div></div>"
    . "<label>Observaciones:</label><br/><textarea class='form-control' id='txaobscancelacion'></textarea><br>";
    if ($publico == 1) {
        echo "<input type='text' id='buzon_rfc' value='$publico' disabled hidden/>";
    }
    echo "<script> $('#divfoliocancelacion').slideUp(); ";
    echo "$('#divvalidacancelacion').slideDown();</script>";
} else {
    echo "<script> alertify.error('El folio no existe o no se encontraron datos para el mismo');</script>";
}

