<?php
include './administracion.dao/dao.php';

$dao = new dao();
$producto = $_GET["producto"];
        
$verificacion=$dao->VerificarProducto($producto);
if($verificacion ==1){
$datos = $dao->consultarListaPrecios();
echo '<select>';
echo'<option value="0">Seleccion una lista de precio</option>';
while ($rs = mysql_fetch_array($datos)) {
    echo' <option value='.$rs[0].' ></option> ';
}
echo '</select>';
}else{
    echo 0;
}



