<?php

include './administracion.dao/dao.php';

$dao = new dao();

$datos = $dao->consultarListaPrecios();

 echo"<div class='table-responsive'><table class='table table-hover'><thead><th>Lista De Precio</th><th>Precio</th><th>alta</th></thead><tbody>";
while ($rs = mysql_fetch_array($datos)) {
$valor = $rs["fusion"];

    $pieces = explode("-", $valor);
    echo"<tr><td>$pieces[0]</td>";
    echo"<td ><input type='text' class='producto' id='texto$pieces[0]'  name='$pieces[1]' disabled    ></td>";
   echo"<td ><input type='checkbox' class='checando' name='check$pieces[0]' id='check$pieces[0]' onchange='tester(\"$pieces[0]\")'/></td></tr>";
}
echo"</tbody></table></div>";

