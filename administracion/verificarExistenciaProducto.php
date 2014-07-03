<?php
include_once './administracion.dao/dao.php';
$dao = new dao;
$datos=$dao->comprobarCodigoValido2($_GET["codigoProducto"]);
$total = mysql_affected_rows();
if($total >0){
while ($rs = mysql_fetch_array($datos)) {
    echo $rs["idGrupoProducto"];
}
}else{
    echo "";
}