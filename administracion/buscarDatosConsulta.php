<?php

session_start();
include_once '../daoconexion/daoConeccion.php';
include_once './administracion.dao/dao.php';

$bnd_es = $_GET["bnd_es"];
$bnd_tipoconsulta = $_GET["bnd_tipoconsulta"];
$fecha_inicial = $_GET["fecha_inicial"];
$fecha_final = $_GET["fecha_final"];
$txt_rfc = $_GET["txt_rfc"];
$txt_user = $_GET["txt_user"];
$suc = $_SESSION["sucursalSesion"];

$dao = new dao();
$cn = new coneccion();

if ($bnd_es == 1) {
    if ($bnd_tipoconsulta == 1) {
        $query = "SELECT * FROM xmlcomprobantes xcm "
                . "WHERE xcm.tipoComprobante = 'Ventas'  AND idSucursal = '$suc' AND xcm.statusOrden = '3' OR xcm.statusOrden = '9'";
    }
    if ($bnd_tipoconsulta == 2) {
        $query = "SELECT * FROM xmlcomprobantes xcm "
                . "WHERE xcm.tipoComprobante = 'Ventas' AND idSucursal = '$suc' "
                . "AND xcm.fechaMovimiento BETWEEN '$fecha_inicial' AND '$fecha_final' AND xcm.statusOrden = '3' OR xcm.statusOrden = '9'";
    }
    if ($bnd_tipoconsulta == 3) {
        $query = "SELECT * FROM xmlcomprobantes xcm "
                . "WHERE xcm.tipoComprobante = 'Ventas' AND xcm.rfcComprobante = '$txt_rfc' AND idSucursal = '$suc' AND xcm.statusOrden = '3' OR xcm.statusOrden = '9'";
    }

    if ($bnd_tipoconsulta == 5) {
        $query = "SELECT * FROM xmlcomprobantes xcm "
                . "WHERE xcm.tipoComprobante = 'Ventas'  AND xcm.rfcComprobante = '$txt_rfc' AND idSucursal = '$suc' "
                . "AND xcm.fechaMovimiento BETWEEN '$fecha_inicial' AND '$fecha_final' AND xcm.statusOrden = '3' OR xcm.statusOrden = '9'";
    }
}
if ($bnd_es == 2) {
    if ($bnd_tipoconsulta == 1) {
        $query = "SELECT * FROM xmlcomprobantes xcm "
                . "WHERE xcm.tipoComprobante = 'Ventas' AND xcm.statusOrden = '7' AND idSucursal = '$suc' ";
    }
    if ($bnd_tipoconsulta == 2) {
        $query = "SELECT * FROM xmlcomprobantes xcm "
                . "WHERE xcm.tipoComprobante = 'Ventas' AND xcm.statusOrden = '7'"
                . "AND xcm.fechaMovimiento BETWEEN '$fecha_inicial' AND '$fecha_final' AND idSucursal = '$suc' ";
    }
    if ($bnd_tipoconsulta == 3) {
        $query = "SELECT * FROM xmlcomprobantes xcm "
                . "WHERE xcm.tipoComprobante = 'Ventas' AND xcm.statusOrden = '7' AND xcm.rfcComprobante = '$txt_rfc' AND idSucursal = '$suc' ";
    }
    if ($bnd_tipoconsulta == 4) {
        $query = "SELECT * FROM xmlcomprobantes xcm "
                . "INNER JOIN ventasusuario vu ON vu.idXmlComprobante = xcm.idXmlComprobante "
                . "WHERE xcm.tipoComprobante = 'Ventas' AND xcm.statusOrden = '7' AND vu.usuario = '$txt_user' AND idSucursal = '$suc' ";
    }
    if ($bnd_tipoconsulta == 5) {
        $query = "SELECT * FROM xmlcomprobantes xcm "
                . "WHERE xcm.tipoComprobante = 'Ventas' AND xcm.statusOrden = '7' AND xcm.rfcComprobante = '$txt_rfc' AND idSucursal = '$suc' "
                . "AND xcm.fechaMovimiento BETWEEN '$fecha1' AND '$fecha2'";
    }
    if ($bnd_tipoconsulta == 6) {
        $query = "SELECT * FROM xmlcomprobantes xcm "
                . "WHERE xcm.tipoComprobante = 'Ventas' AND xcm.statusOrden = '7' vu.usuariousuario = '$txt_user' AND idSucursal = '$suc' "
                . "AND xcm.fechaMovimiento BETWEEN '$fecha1' AND '$fecha2'";
    }
}

$cn->Conectarse();
$ctrl = $dao->buscarDatosConsulta($query);
if (!is_resource($ctrl)) {
    if ($ctrl == null) {
        echo "<br><div class='well well-sm'><label>No hay datos</label></div>";
    } else {
        echo $ctrl;
    }
} else {
    echo "<br><div class='well well-sm'><div class='table-responsive'><table class='table table-hover' id='dtdconsulta'>"
    . "<thead>"
    . "<th>Folio</th>"
    . "<th>Nombre del cliente</th>"
    . "<th>Fecha de movimiento</th>"
    . "<th>Subtotal</th>"
    . "<th>Decuento</th>"
    . "<th>Total</th>"
    . "<th>Imprimir detalles</th>"
    . "</thead>"
            . "<tbody>";
    while ($rs = mysql_fetch_array($ctrl)) {
        echo "<tr><td>$rs[folioComprobante]</td><td>$rs[nombreCliente]</td><td>$rs[fechaMovimiento]</td><td>$rs[subtotalComprobante]</td><td>$rs[desctTotalComprobante]</td><td>$rs[totalComprobante]</td><td><center><button type='button' onclick='imprime_datos(\"$rs[idXmlComprobante]\");' class='btn btn-sm'><span class='glyphicon glyphicon-print'></span></button></center></td></tr>";
    }
    echo "</tbody>"
    . "</table>"
    . "</div>"
    . "</div>";
}
$cn->cerrarBd();


