<?php

session_start();
include_once './administracion.dao/dao.php';
$dao = new dao();
$rfc = "";
$rfc = $_GET["rfc"];
$idSucursal = $_SESSION["sucursalSesion"];
$rs = $dao->dameCredito($rfc);
$rs1 = $dao->dameTotalCredito($idSucursal, $rfc);

if ($rs == false || $rs1 == false) {
    echo mysql_error();
} else {
    while ($creditoUsado = mysql_fetch_array($rs1)) {
        $creditoU = $creditoUsado[0];
    }
    while ($rsCredito = mysql_fetch_array($rs)) {
        $creditoDisponible = $rsCredito[0];
    }
    if ($creditoU == null) {
        $creditoU = 0;
    }
    $totalCredito = 0;
    $totalCredito = $creditoDisponible - $creditoU;
    echo '<div id = "creditoCliente">';
    echo '<strong>Credito : ' . $creditoDisponible . " / " . $creditoU . "</strong>";
    echo '<br/>';
    echo '<strong>Limite Credito : <span id="credito">' . $totalCredito . "</span><strong>";
    echo '</div>';
}
