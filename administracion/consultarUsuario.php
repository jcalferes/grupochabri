<?php

include './administracion.dao/dao.php';
session_start();
$sucursal = $_SESSION["sucursalSesion"];
$dao = new dao();
$datos = $dao->consultaUsuario($sucursal);
//echo'<center><button type="button" class="btn btn-xs btn-default" id="btnver" onclick="eliminarMarcas()"><span class="glyphicon glyphicon-trash"></span></button></center>';
echo"<div class='table-responsive' ><table class='table table-hover' id='dtusuario'><thead><th>Usuario</th><th>Nombre</th><th>Ape. Paterno</th><th>Ape. Materno</th><th>Tipo</th><th>Editar</th></thead><tbody>";
while ($rs = mysql_fetch_array($datos)) {
    echo"<tr><td>$rs[usuario]</td>";
    echo"<td>". ucwords(strtolower($rs["nombre"]))."</td>";
    echo"<td>". ucwords(strtolower($rs["apellidoPaterno"]))."</td>";
    echo"<td>". ucwords(strtolower($rs["apellidoMaterno"]))."</td>";
    echo"<td>". ucwords(strtolower($rs["tipoUsuario"]))."</td>";
    echo"<td><button type='button' class='btn btn-sm' onclick='editalo(\"$rs[usuario]\");'><span class=\"glyphicon glyphicon-pencil\"/></button></tr>";
}
echo"</tbody></table></div>";

