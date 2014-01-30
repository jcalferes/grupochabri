<?php

include './administracion.dao/dao.php';
$dao = new dao();
$datos = $dao->consultaProducto();
echo'<option value= 0> Seleccione un producto  </option>';
while ($rs = mysql_fetch_array($datos)) {
   
    echo'<option value=' . $rs[4] . '> ' . $rs[0] . '  </option>';
}