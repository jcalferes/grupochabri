
<?php

session_start();
include './administracion.clases/Detalle.php';
include './administracion.clases/Encabezado.php';
include './administracion.dao/dao.php';

$encabezado = new Encabezado();
$detalle = new Detalle();

$encabezado = $_SESSION['objEncabezado'];


