<?php

include '../utilerias/Utilerias.php';
$utilerias = new Utilerias();
$chars = "abcdefghijklmnopqrstuvwyz";
$long = 4;
$code = "";
for ($x = 0; $x <= $long; $x++) {
    $rand = rand(1, strlen($chars));
    $code .= substr($chars, $rand, 1);
}
$correo[0] = $_GET["correo"];

$mensaje = "<h1>Codigo de Seguridad para el cambio de contraseña</h1>"
        . "<br/>"
        . "Codigo : " . $code;
$correo[0] = "comodoro_21@hotmail.com";
$envio = $utilerias->enviarCorreo($correo, $mensaje);
echo $code;
