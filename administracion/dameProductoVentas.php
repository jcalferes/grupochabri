<?php

session_start();
include './administracion.clases/Producto.php';
include './administracion.dao/dao.php';
include './administracion.clases/Codigo.php';
$data = json_decode($_POST['data']);
$dao = new dao();
$nuevoArray = Array();
$longitud = 0;
$longitudCodigos = count($data);
$datos = array_count_values($data);
foreach ($datos as $key => $val) {
    $codigo = new Codigo();
    $codigo->setCodigo($key);
    $codigo->setCantidad($val);
    $nuevoArray[] = $codigo;
}
$id = $_SESSION["sucursalSesion"];
include_once '../daoconexion/daoConeccion.php';
$cn = new coneccion();
$cn->Conectarse();
$contador = 0;
foreach ($nuevoArray as $lstDatos) {
    $rs = $dao->buscarProductoVentas($lstDatos, $id);
    while ($resultSet = mysql_fetch_array($rs)) {
        $paso = true;
        $arr[$contador] = array(
            'codigoProducto' => $resultSet[0],
            'producto' => $resultSet[1],
            'costo' => $resultSet[2],
            'cantidad' => $lstDatos->getCantidad()
        );
        $contador++;
    }
}
$cn->cerrarBd();
echo '' . json_encode($arr) . '';
?>
