<?php

include './administracion.dao/dao.php';
$dao = new dao();
$codigo = $_GET["codigoProducto"];
$datos =$dao->mostrarTarifasTabla($codigo);

