<?php

include './administracion.clases/Detalle.php';
session_start();
$x = new Detalle();
$posicion = $_GET["id"];
$porcentaje = $_GET["porcentaje"];
$arrayDetalleSalida = $_SESSION['arrayDetalle'];
$x = $arrayDetalleSalida[$posicion - 1];
$precioUnitario = $x->getPreciounitario();
$cantidad = $x->getCantidad();

$precioRegla = (($porcentaje * $precioUnitario) / 100);
$precio = $precioUnitario - $precioRegla;
$precioTotal = $precio;
echo $precioTotal;

