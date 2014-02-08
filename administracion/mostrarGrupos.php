<?php
include './administracion.dao/dao.php';
$dao = new dao();
$datos = $dao->consultarGrupos();
//echo '<select id="selectGrupo" style="width: 40%; height: 35px" class="selectpicker" data-container="body" data-live-search="true">';
echo'<option value="0">Seleccione un Grupo</option>';
while ($rs = mysql_fetch_array($datos)) {
    echo'<option value='.$rs[0].'>' . $rs[1] . '</option>';
}
//echo '</select>';