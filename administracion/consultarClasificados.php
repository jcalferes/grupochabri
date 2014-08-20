<?php
session_start();
include_once './administracion.dao/dao.php';
$dao = new dao;
$datos = $dao->consultaClasificados();
echo"<div class='table-responsive' ><table class='table table-hover' id='dtclasificados'><thead><th>Codigo Producto</th><th>Nombre</th><th>Grupo</th><th>Tipo</th><th>Imagenes</th></thead><tbody>";
while ($rs = mysql_fetch_array($datos)) {
    echo"<tr>";
    echo"<td>$rs[codigoProducto]</td>";
    echo"<td>$rs[producto]</td>";
    echo"<td>$rs[grupoProducto]</td>";
    echo"<td>$rs[TiposProducto]</td>";
         echo "<td><center><button type='button' class='btn btn-xs' value='Detalles' onclick='gestionimagenes(" . "\"$rs[codigoProducto]\"" . "," . "\"$rs[producto]\"" . ")' ><span class='glyphicon glyphicon-info-sign'></span></button></center></td></tr>";

}
echo"</tr></tbody></table></div>";


