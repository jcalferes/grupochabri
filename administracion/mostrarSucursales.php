<?php

include_once '../daoconexion/daoConeccion.php';
include_once './administracion.dao/dao.php';

$cn = new coneccion();
$dao = new dao();

$cn->Conectarse();
$ctrl = $dao->mostrarsucursales();
if (!is_resource($ctrl)) {
    echo "<span>ERROR: $ctrl</span>";
} else {
    echo '<select id="slcsucursal" class="selectpicker" data-container="body" data-width="auto">';
    echo'<option value="0">Seleccione una sucursal...</option>';
    while ($rs = mysql_fetch_array($ctrl)) {
        echo'<option value=' . $rs["idSucursal"] . '>' . ucwords(strtolower($rs["sucursal"])) . '</option>';
    }
    echo '</select>';
}
$cn->cerrarBd();
