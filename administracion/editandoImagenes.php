
<?php

include_once './administracion.dao/dao.php';
include_once './administracion.clases/clasificados.php';
include_once './administracion.clases/tiposProducto.php';
$dao = new dao();
$clasificados = new clasificados();
$tipos = new tiposProducto();
$ruta = "../subidas/";
$cont = 0;
$nombres = array();
$clasificados->setDescripcion($_POST["descripcion"]);
$clasificados->setCodigoProducto($_POST["codigoProducto"]);
$clasificados->setIdTipo($_POST["tipo"]);
$clasificados->setPonerNovedades($_POST["novedades"]);
$clasificados->setPonerRecomendado($_POST["recomendado"]);
$codigoProducto = $_POST["codigoProducto"];
$imagenesBorradas =  json_decode($_POST["imagenesBorradas"]);
if(count($imagenesBorradas) > 0){
    $dao->borrarImagenes($imagenesBorradas,$clasificados);
}

$nombresDisponibles=$dao->obtenerImagenesDisponibles($clasificados);
$id_prod = $dao->obtenerIdParaNombrarImagen($codigoProducto);

//$descripcion = $_POST["descripcion"];
//$tipo = $_POST["tipo"];
//$grupo = $_POST["grupo"];
//$codigoProducto = $_POST["codigoProducto"];
foreach ($_FILES as $key) {
    if ($key['error'] == UPLOAD_ERR_OK) {//Verificamos si se subio correctamente
        $nombre = $id_prod . '-_-' . $nombresDisponibles[$cont] . '.jpg'; //Obtenemos el nombre del archivo
        $nombres[] = $nombre;
        $temporal = $key['tmp_name']; //Obtenemos el nombre del archivo temporal
        move_uploaded_file($temporal, $ruta . $nombre); //Movemos el archivo temporal a la ruta especificada
        //El echo es para que lo reciba jquery y lo ponga en el div "cargados"
        echo "okey";
    } else {
        echo $key['error']; //Si no se cargo mostramos el error
    }
    $cont++;
}
$dao->edtitarClasificados($clasificados,$nombres);