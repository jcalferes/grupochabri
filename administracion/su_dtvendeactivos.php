<?php

include_once '../daoconexion/daoConeccion.php';
include_once './administracion.dao/dao.php';

$cn = new coneccion();
$dao = new dao();

$cn->Conectarse();
$ctrl = $dao->dtvendeactivos();
if (!is_resource($ctrl)) {
    echo $ctrl;
} else {
    echo"<div class='table-responsive' >"
    . "<table class='table table-hover' id='dtvendeactivos'>"
    . "<thead><th>Nombre</th><th>Apellido Paterno</th><th>Apellido Materno</th><th>Usuario</th><th>Sucursal</th><th>Tipo</th><th></th></thead>"
    . "<tbody>";
    while ($rs = mysql_fetch_array($ctrl)) {
        echo"<tr><td>" . ucwords(strtolower($rs["nombre"])) . "</td><td>" . ucwords(strtolower($rs["apellidoPaterno"])) . "</td><td>" . ucwords(strtolower($rs["apellidoMaterno"])) . "</td><td>" . ucwords(strtolower($rs["usuario"])) . "</td><td>" . ucwords(strtolower($rs["sucursal"])) . "</td><td>" . ucwords(strtolower($rs["tipoUsuario"])) . "</td><td><button class='btn btn-sm' style='background-color: white' onclick='confusuario(\"$rs[idUsuario]\",\"$rs[idTipoUsuario]\");'><span class='glyphicon glyphicon-cog'></span></button></td></tr>";
    }
    echo"</tbody>"
    . "</table>"
    . "</div>";
}

$cn->cerrarBd();

