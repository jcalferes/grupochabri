<?php

include './administracion.dao/dao.php';
$dao = new dao();
$rs = $dao->dameFolio();
while ($datos = mysql_fetch_array($rs)) {
    echo '<label style = "color: red; font-size: 15px">Folio: ' . $datos[0] . '</label>';
}