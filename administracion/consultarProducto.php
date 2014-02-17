<?php

include './administracion.dao/dao.php';
$dao = new dao();
$datos = $dao->consultaProducto();
$datos2 = $dao->consultaTableConsulta();
$comprobar = "";
$rs2="";
$rs="";
$idProducto="";
echo"<div class='table-responsive'><table class='table table-hover'><thead><th>Editar</th><th>Producto</th><th>Proveedor</th><th>Marca</th><th>Costo</th><th>En existencia</th><th>Lista de precios</th></thead><tbody>";
while ($rs = mysql_fetch_array($datos)) {
    $comillas=str_replace("\"","\\\"",$rs['producto']);
    echo"<tr ><td><input type='checkbox' id='eliminar' onclick='eliminar()'><input  type='button' id ='detalleTarifa' class='btn btn-primary' data-dismiss='modal' data-toggle='modal' data-target='#mdlDetalleTarifa' value='+' style='display: none;'></td> ";
    echo"<td >$rs[producto]</td>";
    $comprobar = $rs['codigoProducto'];
    echo"<td>$rs[codigoProducto]</td>";
    echo"<td id='$rs[marca]' >$rs[marca] </td>";
    echo"<td id='$rs[costo]' >$rs[costo] </td>";
    while ($rs2 = mysql_fetch_array($datos2)) {
        if ($comprobar === isset($rs2['idProducto'])) {
            if ($rs2[cantidad] !== "") {
                echo"<td>$rs2[cantidad]</td>";
            }
        }else {
            echo '<td>0</td>';
        }
    }
    echo "<td><a onclick='gestionTarifas(" . "\"$rs[codigoProducto]\"" .",". "\"$comillas\"" . ")' >detalles</a></td></tr>";
    mysql_data_seek($datos2, 0);
}
echo"</tbody></table></div>";

