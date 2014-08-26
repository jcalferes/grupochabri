<?php

include_once './administracion.dao/dao.php';
include_once '../daoconexion/daoConeccion.php';

$dao = new dao();
$cn = new coneccion();

$cn->Conectarse();
$ctrl = $dao->buscarNoPublicados();
if (!is_resource($ctrl)) {
    $ctrl = mysql_error();
    echo "ERROR: $ctrl";
} else {
    echo "<div class='table-responsive'><table id='tdnopublicados' class='table table-hover'><thead><th>Nompra</th><th>Codigo</th><th></th></thead><tbody>";
    while ($rs = mysql_fetch_array($ctrl)) {
        echo "<tr>";
        echo "<td>". ucwords(strtolower($rs["producto"])) ."</td><td>$rs[codigoProducto]</td><td><center><button type='button' class='btn btn-defaul' onclick='publicamelo(\"$rs[codigoProducto]\");'><span class='glyphicon glyphicon-pushpin'></span></button></center></td>";
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
    echo "</div>";
}
$cn->cerrarBd();

