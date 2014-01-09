<?php
include '../daoconexion/daoConeccion.php';
include './administracion.clases/productos.php';
include './administracion.dao/daoAdmin.php';
$daoAdmin= new daoAdmin();

$daoAdmin->mostrarTabla();
