<?php

session_start();
$encabezadoEntrada = $_SESSION['objEncabezadoEntrada'];
$arrayDetalleEntrada = $_SESSION['arrayDetalleEntrada'];

$datos = json_decode($_POST['datos']);
$control = count($datos);
echo 'algo';

