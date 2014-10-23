<?php

include_once '../daoconexion/daoConeccion.php';
include_once './administracion.dao/dao.php';

$cn = new coneccion();
$dao = new dao();

$id = $_POST["id"];
$tipo = $_POST["tipo"];

$cn->Conectarse();
$ctrl = $dao->su_obtenerdatosusuario($id, $tipo);
if (!is_resource($ctrl)) {
    echo $ctrl;
} else {
    while ($rs = mysql_fetch_array($ctrl)) {
        $arr['usuario']['datos'] = array('usuario' => $rs["usuario"], 'nombre' => $rs["nombre"], 'apaterno' => $rs["apellidoPaterno"], 'amaterno' => $rs["apellidoMaterno"], 'tipo' => $rs["idtipousuario"], 'sucursal' => $rs["idSucursal"], 'idusuario' => $rs["idUsuario"]);
    }
    echo json_encode($arr);
}
$cn->cerrarBd($arr);



