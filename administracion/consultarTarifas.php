<?php

include './administracion.dao/dao.php';

$dao = new dao();

$datos = $dao->consultarListaPrecios();

 echo"<div class='table-responsive'><table class='table table-hover'><thead><th>Lista De Precio</th><th>Precio</th><th>alta</th></thead><tbody>";
while ($rs = mysql_fetch_array($datos)) {
$valor = $rs["fusion"];

    $pieces = explode("-", $valor);
    $validando1= str_replace(" ","_", $pieces[0]);
   
    echo"<tr><td>$pieces[0]</td>";
    echo"<td ><input type='text' class='producto form-control' id='texto$validando1' onkeypress='return NumCheck(event, this);'   name='$pieces[1]' disabled></td>";
   echo"<td ><input type='checkbox' class='checando' name='check$validando1' id='check$validando1' onchange='tester(\"$validando1\")'/></td></tr>";
}
echo"</tbody></table></div>";

