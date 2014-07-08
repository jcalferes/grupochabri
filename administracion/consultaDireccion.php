<?php

include_once './administracion.dao/dao.php';
$dao = new dao();
$idSucursal = $_GET["id"];
$rfc = $_GET["rfc"];
$datos = $dao->obtieneDireccionDeProveedor($idSucursal);
$datos2 = $dao->puleaTelefono($rfc);
$datos3 = $dao->puleaEmails($rfc);
echo "<h4>Direccion</h4>";
echo "<div class='table-responsive'><table class='table table-hover' id='dtproveedor'>";
echo "<thead><th></th><th></th></thead>";
echo "<tbody>";
while ($rs = mysql_fetch_array($datos)) {
    echo "<tr><td><label>Calle:</label></td><td>$rs[calle]</td></tr>";
    echo "<tr><td><label>No. Exterior:</label></td><td>$rs[numeroExterior]</td></tr>";
    echo "<tr><td><label>No. Interior:</label></td><td>$rs[numeroInterior]</td></tr>";
    echo "<tr><td><label>Cruzamientos:</label></td><td>$rs[cruzamientos]</td></tr>";
    echo "<tr><td><label>CP:</label></td><td>$rs[postal]</td></tr>";
    echo "<tr><td><label>Colonia:</label></td><td>$rs[colonia]</td></tr>";
    echo "<tr><td><label>Estado:</label></td><td>$rs[estado]</td></tr>";
    echo "<tr><td><label>Ciudad:</label></td><td>$rs[ciudad]</td></tr>";
}
echo "</tbody>";
echo "</table></div>";
if ($datos2 != false) {
    echo "<h4>Telefono(s)</h4>";
    echo "<div class='table-responsive'><table class='table table-hover' id='dtproveedor'>";
    echo "<thead><th></th></thead>";
    echo "<tbody>";
    while ($rs = mysql_fetch_array($datos2)) {
        echo "<tr><td>$rs[telefono]</td></tr>";
    }
    echo "</tbody>";
    echo "</table></div>";
    echo "<hr>";
    echo "</tbody>";
    echo "</table></div>";
}
if ($datos3 != false) {
    echo "<h4>Email(s)</h4>";
    echo "<div class='table-responsive'><table class='table table-hover' id='dtproveedor'>";
    echo "<thead><th></th></thead>";
    echo "<tbody>";
    while ($rs = mysql_fetch_array($datos3)) {
        echo "<tr><td>$rs[email]</td></tr>";
    }
    echo "</tbody>";
    echo "</table></div>";
}