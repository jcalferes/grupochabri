<?php
include './administracion.dao/dao.php';
$dao = new dao();
$codigo= $_GET["codigoProducto"];
$datos = $dao->comprobarCodigoValido($codigo);

if($datos==1){
    echo 1;
}else{
 echo 0;   
}