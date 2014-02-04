<?php

include './administracion.dao/dao.php';
include './administracion.clases/GrupoProductos.php';
$grupo = new GrupoProductos();
$dao = new dao();
$grupo->setGrupoProducto($_GET["nombreGrupo"]);
$ok=$dao->guardarGrupo($grupo);

echo $ok;
?>