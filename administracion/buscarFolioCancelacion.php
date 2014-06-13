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
    echo "<div class='table-responsive'><table class='table table-hover'><thead><th>Folio</th><th>RFC del cliente</th><th>Desc. Total</th><th>Total</th></thead><tbody>";
    while ($rs = mysql_fetch_array($datos)) {
        echo "<tr>";
        echo "<td>$rs[folioComprobante]</td>";
        echo "<td>$rs[rfcComprobante]</td>";
        echo "<td>$rs[desctTotalComprobante]</td>";
        echo "<td>$rs[totalComprobante]</td>";
    }
    echo "</tbody></table></div>";
} else {
    echo "ERROR: AL OBTENER DATOS";
}

