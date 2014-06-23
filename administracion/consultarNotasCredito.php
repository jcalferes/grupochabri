<?php

session_start();
include_once '../daoconexion/daoConeccion.php';
include './administracion.dao/dao.php';
$sucursal = $_SESSION["sucursalSesion"];
$dao = new dao();
$cn = new coneccion();
$cn->Conectarse();
$datos = $dao->consultarNotasCredito($sucursal);
if ($datos == false) {
    echo"<div class='table-responsive' ><table class='table table-hover' id='dtnotascredito'><thead><th>Marca</th></thead><tbody>";
    echo"<tr>";
    echo"<td>NO HAY DATOS</td></tr>";
    echo"</tr></tbody></table></div>";
} else {
    echo"<div class='table-responsive' ><table class='table table-hover' id='dtnotascredito'><thead><th>Cliente</th></thead><tbody>";
    while ($rs = mysql_fetch_array($datos)) {
        echo"<tr>";
        echo"<td>$rs[idCliente]</td></tr>";
    }
    echo"</tr></tbody></table></div>";
}
$cn->cerrarBd();


