<?php

include './administracion.dao/dao.php';
session_start();
$dao = new dao();
$rfc = "";
$rfc = $_GET["rfc"];
$idSucursal = $_SESSION["sucursalSesion"];
$rs = $dao->obtenerOrdenCompraClientes($rfc, $idSucursal);
if ($rs == false) {
//    echo '<div>';
    echo '<select id="cmbOrdenCompra" class="form-control">';
    echo '<option>' . mysql_error() . '</option>';
    echo '</select>';
//    echo '</div>';
} else {
//    echo '<div >';
    echo '<select id="cmbOrdenCompraV" class="form-control">';
    echo '<option value="0">Seleccione una orden de compra</option>';
    while ($datos = mysql_fetch_array($rs)) {
        echo '<option value ="' . $datos["idXmlComprobante"] . '">' . $datos["fechaMovimiento"] . '</option>';
    }
    echo '</select>';
//    echo '</div>';
}
    