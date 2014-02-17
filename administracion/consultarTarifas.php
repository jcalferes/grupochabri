<?php

include './administracion.dao/dao.php';

$dao = new dao();

$datos = $dao->consultarListaPrecios();

 echo"<div class='table-responsive'><table class='table table-hover'><thead><th>Lista De Precio</th><th>Precio</th><th>alta</th></thead><tbody>";
while ($rs = mysql_fetch_array($datos)) {
$valor = $rs["fusion"];

    $pieces = explode("-", $valor);
    $espacios=str_replace(" ","-",$pieces[1]);
    $espacios2=str_replace(" ","-",$pieces[0]);
    echo"<tr><td>$pieces[0]</td>";
    echo"<td ><input type='text' class='producto form-control' id='texto$espacios'  name='$espacios2' disabled></td>";
   echo"<td ><input type='checkbox' class='checando' name='check$pieces[0]' id='check$pieces[0]' onchange='tester(\"$pieces[0]\")'/></td></tr>";
}
echo"</tbody></table></div>";

