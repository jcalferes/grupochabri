<?php

include './administracion.dao/dao.php';
$dao = new dao();
$datos = $dao->consultarListaPrecios();
echo '<select>';
while ($rs = mysql_fetch_array($datos)) {
    echo'<option>' . $rs["1"] . '</option>';
}
echo '</select>';

