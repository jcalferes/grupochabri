<?php

include './administracion.dao/dao.php';
$dao = new dao();
$idCliente = $_GET["idCliente"];
$rs = $dao->dameOrdenesCanceladas($idCliente);
if ($rs == false) {
    echo '<select id="cmbCancelaciones" class="form-control">';
    echo '<option>"' . mysql_error() . '"</option>';
    echo '</select>';
} else {
    echo '<select id="cmbCancelaciones" class="form-control">';
    echo '<option value="0,0">Seleccione una Cancelación</option>';
    while ($rsNotas = mysql_fetch_array($rs)) {
        echo '<option value="' . $rsNotas["folioComprobante"] . ',' . $rsNotas["totalComprobante"] . '" ">' . $rsNotas["fechaMovimiento"] . '</option>';
    }
    echo '</select>';
}