<?php

include './administracion.dao/dao.php';
$dao = new dao();
$datos = $dao->consultaProducto();
$datos2 = $dao->consultaTableConsulta();
$comprobar = "";

echo"<div class='table-responsive'><table id='tdProducto' cellpadding='0' cellspacing='0' border='0' class='table table-hover table-bordered'><thead><th>Editar</th><th>Producto</th><th>folio</th><th>CodigoProducto</th><th>Marca</th><th>Costo</th><th>fechaMovimiento</th><th>En existencia</th><th>Lista de precios</th></thead><tbody>";
while ($rs = mysql_fetch_array($datos)) {
    $comillas = str_replace("\"", "\\\"", $rs['producto']);
    echo"<tr ><td><input type='checkbox' id='eliminar' onclick='eliminar()'><input  type='button' id ='detalleTarifa' class='btn btn-primary' data-dismiss='modal' data-toggle='modal' data-target='#mdlDetalleTarifa' value='+' style='display: none;'/></td> ";
    echo"<td >$rs[producto]</td>";
    $comprobar = $rs['codigoProducto'];
    echo"<td>$rs[codigoProducto]</td>";
     echo"<td id='$rs[folioProducto]' >$rs[folioProducto] </td>";
    echo"<td id='$rs[marca]' >$rs[marca] </td>";
    echo"<td id='$rs[costo]' >$rs[costo] </td>";
    echo"<td id='$rs[fechaMovimiento]' >$rs[fechaMovimiento] </td>";
   
    if($datos2 !== 0){
    while ($rs2 = mysql_fetch_array($datos2)) {
        if ($comprobar === isset($rs2['idProducto'])) {
            if ($rs2[cantidad] !== "") {
                echo"<td>$rs2[cantidad]</td>";
            }
        } else {
            echo "<td>0</td>";
        }
    }
    mysql_data_seek($datos2, 0);
    }else{
        echo "<td>0</td>";
    }
    echo "<td><a onclick='gestionTarifas(" . "\"$rs[codigoProducto]\"" . "," . "\"$comillas\"" . ")' >detalles</a></td></tr>";
    
}
echo"</tbody></table></div>";

