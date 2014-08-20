<?php

include './administracion.dao/dao.php';
$dao = new dao();
$datos = $dao->consultaMaquina();
echo'<center><button type="button" class="btn btn-xs btn-default" id="btnver" onclick="eliminarMaquinas()"><span class="glyphicon glyphicon-trash"></span></button></center>';
echo"<div class='table-responsive' ><table class='table table-hover' id='dtmaquina'><thead><th></th><th>Maquina</th></thead><tbody>";
while ($rs = mysql_fetch_array($datos)) {
    echo"<tr><td><center><input class='checkMaquinas' type='checkbox' id='eliminar' onclick='eliminar()' value='$rs[idMaquina]'></center></td>";
    echo"<td>$rs[nombreMaquina]</td></tr>";
}
echo"</tbody></table></div>";

