<?php
include './administracion.dao/dao.php';
$dao = new dao();
$rfc = $_GET["rfc"];
$array[] =  array();
$array2[]=array();
$datos=$dao->verificandoCliente($rfc);
if($datos == 0){
    echo "1";
}else{
    $rs = mysql_fetch_array($datos,MYSQL_ASSOC);
        foreach ($rs as $campo => $value) {
            $array[$campo] = utf8_encode($value);
//            array_push($array, $array2);
//            $array =$campo => utf8_encode($value); 
        }
    
    echo '' . json_encode($array) . '';
}