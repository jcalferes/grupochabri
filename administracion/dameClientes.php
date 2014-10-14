<?php

include './administracion.dao/dao.php';
$d = new dao();
$rs = $d->dameClientes();
// $dao->dameClientes();

echo '<select class="selectpicker selectores" 
                            data-container="body" 
                            data-live-search="true" >';
if ($rs == false) {
    echo '<option>' . mysql_error() . '</option>';
}
echo '<option value = 0>Venta al Publico</option>';
while ($d = mysql_fetch_array($rs)) {
    echo '<option value = ' . $d[0] . '>' . $d[1] . '</option>';
}
echo '</select>';
