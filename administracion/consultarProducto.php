<?php
session_start();
include './administracion.dao/dao.php';
$dao = new dao();
$datos = $dao->consultaProducto($cn);
$datos2=$dao->consultaTableConsulta();
$_SESSION["consulta2"]=$datos2;
echo"<div class='table-responsive'><table class='table table-hover'><thead><th>Editar</th><th>Producto</th><th>Proveedor</th><th>Marca</th><th>Costo</th><th>En existencia</th></thead><tbody>";
while ($rs = mysql_fetch_array($datos)) {
    echo"<tr><td><input type='checkbox' id='eliminar' onclick='eliminar()'> <a id='editar' onclick='editar()'>Editar</a> </td>";
    echo"<td >$rs[idProducto]</td>";
    $comprobar=$rs[idProducto];
    echo"<td>$rs[producto]</td>";
    echo"<td id='$rs[marca]' >$rs[marca] </td>";
   echo"<td id='$rs[costo]' >$rs[costo] </td>";
    while ($rs2 = mysql_fetch_array($datos2)) {
        if($comprobar == $rs2[idProducto]){
            echo"<td>$rs2[cantidad]</td></tr>";
                   }
    }
    mysql_data_seek($datos2,0); 
}
echo"</tbody></table></div>";

