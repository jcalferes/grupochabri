<?php

include './administracion.dao/dao.php';
$dao = new dao();
$datos = $dao->consultaUsuario();
//echo'<center><button type="button" class="btn btn-xs btn-default" id="btnver" onclick="eliminarMarcas()"><span class="glyphicon glyphicon-trash"></span></button></center>';
echo"<div class='table-responsive' ><table class='table table-hover' id='dtusuario'><thead><th>Usuario</th><th>Nombre</th><th>Ape. Paterno</th><th>Ape. Materno</th></thead><tbody>";
while ($rs = mysql_fetch_array($datos)) {
    echo"<tr><td>$rs[usuario]</td>";
    echo"<td>$rs[nombre]</td>";
    echo"<td>$rs[apellidoPaterno]</td>";
    echo"<td>$rs[apellidoMaterno]</td></tr>";
}
echo"</tbody></table></div>";

