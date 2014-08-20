<?php

include './administracion.dao/dao.php';
$dao = new dao();
$datos = $dao->consultarProveedores();
echo '<select id="selectProveedor" class="selectpicker" data-container="body" data-live-search="true">';
echo'<option value="0">Seleccion un proveedor </option>';
while ($rs = mysql_fetch_array($datos)) {
    echo'<option value=' . $rs["idProveedor"] . '>' . utf8_encode($rs["nombre"]) . '</option>';
}
echo '</select>';
