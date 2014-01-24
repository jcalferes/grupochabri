<?php
include './administracion.dao/dao.php';
$dao= new dao();
$datos=$dao->consultaProducto();
while ($rs = mysql_fetch_array($datos)) {
           echo'<option value='.$rs[1].'>  </option>';
        }