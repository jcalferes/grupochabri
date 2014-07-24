<?php

include './administracion.dao/dao.php';
$dao = new dao();
$idFolio = $_GET["idFolio"];
$rs= $dao->eliminarOrdenCompra($idFolio);
if ($rs == false){
    echo mysql_error();
}
else{
    echo 'Orden de compra eliminado';
}