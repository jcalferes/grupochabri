<?php

include_once './administracion.dao/dao.php';
$dao = new dao();
$datos = $dao->consultaListaPrecio();
echo"<div class='table-responsive'><table class='table table-hover' id='dtlistaprecios'><thead><th>Editar</th><th>Nombre</th></thead><tbody>";
while ($rs = mysql_fetch_array($datos)) {
    echo"<tr><td><input type='checkbox' id='eliminar' onclick='eliminar()'value='$rs[idListaPrecio]'>  </td>";
    echo"<td>$rs[nombreListaPrecio]</td>";
}

echo"</tbody></table></div>";
