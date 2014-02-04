<?php
include './administracion.dao/dao.php';
$dao = new dao();
$datos = $dao->consultarMedidas();
echo '<select id="selectMedida" class="selectpicker" data-container="body" data-live-search="true">';
echo'<option value="0">Seleccion una Unidad</option>';
while ($rs = mysql_fetch_array($datos)) {
    echo'<option value='.$rs[0].'>' . $rs[1] . '</option>';
}
echo '</select>';