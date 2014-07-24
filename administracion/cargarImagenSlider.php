<?php

session_start();
include_once '../daoconexion/daoConeccion.php';
include './administracion.dao/dao.php';

$sucursal = $_SESSION["sucursalSesion"];
$lahora = date("d/m/Y");

$cn = new coneccion();
$dao = new dao();

$cn->Conectarse();
$vald = $dao->validaImagenSlider();
if ($vald == 0) {
    //Como no sabemos cuantos archivos van a llegar, iteramos la variable $_FILES
    $ruta = "../subidas/";
    foreach ($_FILES as $key) {
        if ($key['error'] == UPLOAD_ERR_OK) {//Verificamos si se subio correctamente
            $nombre = $key['name']; //Obtenemos el nombre del archivo
            $temporal = $key['tmp_name']; //Obtenemos el nombre del archivo temporal
            move_uploaded_file($temporal, $ruta . $nombre); //Movemos el archivo temporal a la ruta especificada
            //El echo es para que lo reciba jquery y lo ponga en el div "cargados"
        } else {
            echo $key['error']; //Si no se cargo mostramos el error
        }
    }
    $archivo = $ruta . $nombre;

    $ctrl = $dao->subirImgenSlider($sucursal, $lahora, $archivo);
    $cn->cerrarBd();
    if ($ctrl == false) {
        echo 1;
    } else {
        echo 0;
    }
} else {
    echo 666;
}








