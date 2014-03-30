<?php
include_once './administracion.dao/dao.php';
$dao = new dao();
$datos=$dao -> consultaSucursales();
if($datos != false){
    echo "<option value='0'>Seleccione una Sucursal</option>";
while ($rs = \mysql_fetch_array($datos)) {
    echo "<option value='$rs[idSucursal]'>$rs[sucursal]</option>"; 
   
}
}else{
    echo "<option value='0'>Seleccione una Sucursal</option>";
    
}