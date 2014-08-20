<?php

include './administracion.dao/dao.php';
$dao = new dao();
$datos = $dao->mostrarClientes();
echo '<select id="selectMarca" class="selectpicker" data-container="body" data-live-search="true">';
echo'<option value="0">Seleccione un cliente</option>';
while ($rs = mysql_fetch_array($datos)) {
    echo'<option value=' . $rs[idCliente] . '>' . $rs[nombre] . '</option>';
}
echo '</select>';
