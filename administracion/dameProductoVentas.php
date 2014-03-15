<?php
include './administracion.clases/Producto.php';
include './administracion.dao/dao.php';
$productos = new Producto();
$data = json_decode($_POST['data']);
$codigo = 0;
$dao = new dao();
for ($x = 0; $x <= $data; $x++) {
    $cantidad = 0;
    $codigo = $data[$x];
    for ($y = 0; $y <= $data; $y++) {
        if ($data[$x] == $data[$y]) {
            $productos->setCantidad($cantidad = $cantidad + 1);
        }
        if ($data[$y] == null) {
            break;
        }
    }
    $productos->setCodigoProducto($codigo);
    if ($codigo == null) {
        break;
    } else {
        $rs = $dao->buscarProductoVentas($productos);
        if ($rs == false) {
            echo mysql_error();
        } else {
            $paso = false;
            while ($resultSet = mysql_fetch_array($rs)) {
                $paso = true;
                $arr[$x] = array(
                    'codigoProducto' => $resultSet[0],
                    'producto' => $resultSet[1],
                    'costo' => $resultSet[2],
                    'cantidad' => $productos->getCantidad()
                );
            }
        }
    }
}
echo '' . json_encode($arr) . '';
?>
