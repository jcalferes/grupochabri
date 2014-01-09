<?php
include './administracion.dao/dao.php';
//include '../daoconexion/daoConeccion.php';
//$cn = new coneccion();
$dao = new dao();
$datos = $dao->consultaProducto($cn);
echo"<table border = 1><th>producto</th><th>proveedor</th><th>marca</th><th>costo</th>";


        
while ($rs = mysql_fetch_array($datos)){
    
    echo"<tr><td><input type = submit id= $rs[4]>$rs[0]</td>";
    echo"<td>$rs[1]</td>";
    echo"<td id=$rs[2] ><a type= prr onclick = mostrarMarcas('$rs[2]')>$rs[2]</a> </td>";
    echo"<td>$rs[3]</td></tr>";

    
}

