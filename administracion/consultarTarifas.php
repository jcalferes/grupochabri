<?php

include './administracion.dao/dao.php';

$dao = new dao();

$datos = $dao->consultarListaPrecios();
echo '<select>';
echo'<option value="0">Seleccion una lista de precio</option>';
while ($rs = mysql_fetch_array($datos)) {
    echo' <option value=' . $rs["fusion"] . ' >' . $rs["fusion"] . '</option> ';
}
echo '</select>';



