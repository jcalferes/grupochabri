<?php
include './administracion.dao/dao.php';
$dao = new dao();
$datos = $dao->consultarMarcas();
echo '<select id="selectMarca" class="selectpicker" data-container="body" data-live-search="true">';
echo'<option value="0">Seleccion una Marca</option>';
while ($rs = mysql_fetch_array($datos)) {
    echo'<option value='.$rs[0].'>' . $rs[1] . '</option>';
}
echo '</select>';

