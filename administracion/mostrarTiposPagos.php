<?php

include './administracion.dao/dao.php';
$dao = new dao();
$datos = $dao->mostrarTiposPagos();

if ($datos == 1) {
    echo '<select id="selectMarca" class="selectpicker" data-container="body" data-live-search="true">';
    echo'<option value="0">No hay tipos de pagos</option>';
    while ($rs = mysql_fetch_array($datos)) {
        echo'<option value="0">" Vacio "</option>';
    }
    echo '</select>';
} else {
    echo '<select id="selectTipoUsuario" class="selectpicker" data-container="body" data-live-search="true">';
    echo'<option value="0">Seleccione un tipo de pago</option>';
    while ($rs = mysql_fetch_array($datos)) {
        echo'<option value=' . $rs[0] . '>' . $rs[1] . '</option>';
    }
    echo '</select>';
}