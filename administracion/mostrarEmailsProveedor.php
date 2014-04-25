<?php
include_once './administracion.dao/dao.php';
$dao = new dao();
$rfc = $_GET["rfc"];
$datos = $dao->consultaEmail($rfc);
echo'<option value= 0> Seleccione un Email  </option>';
while ($rs = mysql_fetch_array($datos)) {
   
    echo'<option value=' . $rs[email] . '> ' . $rs[email] . '  </option>';
}