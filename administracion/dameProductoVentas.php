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
$interfaz = "";
$interfaz .= "<table class='table table-hover'>"
        . "<thead>
                <th><center>Codigo</center></th>
                <th><center>Descripcion</center></th> 
                <th><center>Precio</center></th>
                <th><center>Cantidad</center></th>
                <th><center>Lista de Precio</center></th>
                <th><center>Descuento</center></th>
                <th><center>Agregar</center></th>
                <th><center>Eliminar</center></th>
                <th><center>Descuento</center></th>
                <th><center>Total</center></th>
           </thead>";
foreach ($nuevoArray as $lstDatos) {
    $rs = $dao->buscarProductoVentas($lstDatos, $id);
    $rsTarifas = $dao->dameTarifas($lstDatos, $id);
    $codigo = 0;
    $descripcion = "";
    while ($dat = mysql_fetch_array($rs)) {
        $codigo = $dat[0];
        $descripcion = $dat[1];
        $interfaz.="<tr>";
        $interfaz.="<td>" . $codigo . "</td>";
        $interfaz.="<td>" . $descripcion . "</td>";
        $interfaz.="<td>" . $dat[2] . "</td>";
        $interfaz.="<td>" . $lstDatos->getCantidad() . "</td>";
        $interfaz.="<td>";
        $interfaz.="<select class = 'form-control'>";
    }
    while ($rsDatos = mysql_fetch_array($rsTarifas)) {
        $interfaz.="<option value='" . $rsDatos[1] . "'>" . $rsDatos[0] . "</option>";
    }
//    if($rsTarifas == false){
//         $interfaz.="<option value='0'>No hay tarifas para este Producto</option>";
//    }
    $interfaz.="</select>";
    $interfaz.="</td>";
    $interfaz.="<td><input type='text' class='form-control'/></td>";
    $interfaz.="<td><center>"
            . "<button type='submit' class='btn' onclick='agregarProducto(" . "\"$codigo\"" . ");'>"
            . '<span class="glyphicon glyphicon-plus"></span>'
            . '</<button>'
            . "</center></td>";
    $interfaz.="<td><center>"
            . "<button type='submit' class='btn' onclick='quitarProducto(" . "\"$codigo\"" . ");'>"
            . '<span class="glyphicon glyphicon-trash"></span>'
            . '</<button>'
            . "</center></td>";
    $interfaz.="</tr>";
}
$interfaz.="</table>";

echo $interfaz;
?>
