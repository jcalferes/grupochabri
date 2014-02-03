<?php

include './administracion.clases/Detalle.php';
session_start();
$x = new Detalle();
$posicion = $_GET["id"];
$porcentaje = $_GET["porcentaje"];
$arrayDetalle = $_SESSION['arrayDetalle'];
$x = $arrayDetalle[$posicion - 1];
$precioUnitario = $x->getPreciounitario();
$cantidad = $x->getCantidad();

//$precio = ($precioUnitario * ($porcentaje / 100));
$precioRegla = (($porcentaje * $precioUnitario)/100);
$precio = $precioUnitario-$precioRegla;
$precioTotal = $precio;
echo $precioTotal;

