<?php
session_start();
include './administracion.clases/Producto.php';
include './administracion.dao/dao.php';
include './administracion.clases/Codigo.php';
$dao = new dao();
$codigo = new Codigo();
$id = $_SESSION["sucursalSesion"];
$codigo->setCodigo($_GET["codigo"]);
$codigo->setCantidad(1);
include_once '../daoconexion/daoConeccion.php';
$cn = new coneccion();
$cn->Conectarse();
$contador = 0;
$interfaz = "";
$rs = $dao->buscarProductoVentas($codigo, $id);
$rsTarifas = $dao->dameTarifas($codigo, $id);
$codigo1 = 0;
$descripcion = "";
$costo = 0.00;
$disponibilidad = false;
while ($dat = mysql_fetch_array($rs)) {
    $disponibilidad = true;
    $codigo1 = $dat[0];
    $descripcion = $dat[1];
    $interfaz.="<tr id='tr" . $codigo->getCodigo() . "'>";
    $interfaz.="<td><center><span id='codigo" . $codigo->getCodigo() . "'>" . $codigo1 . "</span></center></td>";
    $interfaz.="<td><center><span id='descripcion" . $codigo->getCodigo() . "'>" . $descripcion . "</span></center></td>";
    $costo = $dat[2];
//  ---------------------------------------
    $paso = false;
    $longitud = strlen($codigo1);
    $empezar = $longitud - 3;
    $cadenaComparar = "-GR";
    $cadena = "";
    for ($x = $empezar; $x < $longitud; $x++) {
        $cadena = $cadena . $codigo1[$x];
    }
    if ($cadenaComparar == $cadena) {
        $paso = true;
    }
//  -------------------------------------------
    if ($paso == false) {
        $interfaz.="<td>"
                . "<center>"
                . "<input onkeyup='calcularTotal(" . "\"$codigo1\"" . ")'    class='form-control' type='text' id='txt" . $codigo->getCodigo() . "' value ='" . $codigo->getCantidad() . "'/>"
                . "</center></td>";
    } else {
        $interfaz.="<td style='width: 150px'>"
                . "<div class='input-group'>
                         <input type='text' id='txt" . $codigo->getCodigo() . "' 
                             class='form-control' placeholder='Cant. Kg'
                             onkeyup='calcularTotal(" . "\"$codigo1\"" . ")'
                             value='1000'/>
                         <span class='input-group-btn'>
                            <button class='btn btn-default' type='button' onclick='modalProductosGranel(" . "\"$codigo1\"" . ")'>
                                <span class='glyphicon glyphicon-plus'></span>
                             </button>
                          </span>
                       </div>"
                . "</td>";
    }
    $interfaz.="<td><span id='txtExistencia" . $codigo->getCodigo() . "'>" . $dat[3] . "</span></td>";
    $interfaz.="<td>";
    $interfaz.="<select class = 'form-control' id='cmb" . $codigo1 . "' onchange='cambiarTarifas(" . "\"$codigo1\"" . ");'>";
}

if ($disponibilidad == true) {
    $costoVenta = 0.00;
    $costoMenudeo = 0.00;
    while ($rsDatos = mysql_fetch_array($rsTarifas)) {
        $interfaz.="<option ";
        if ($rsDatos[1] == 'Menudeo') {
            $interfaz.="selected='true'";
            $costoMenudeo = ($costo * $rsDatos[2]) + $costo;
        }
        $costoVenta = ($costo * $rsDatos[2]) + $costo;
        $interfaz .="value='".$rsDatos[0] .",". $costoVenta . "'>" . $rsDatos[1] . ""
                . "</option>";
    }
    $interfaz.="</select>";
    $interfaz.="</td>";
    $interfaz.="<td><center><span id='precioVnt" . $codigo->getCodigo() . "'>" . $costoMenudeo . "</span></center></td>";
    $interfaz.="<td><input style='width:60px' id='txtDescuentos" . $codigo1 . "' onkeyup='calcularDescuentos(" . "\"$codigo1\"" . ")' type='text'  class='form-control'/></td>";
    $interfaz.="<td><center>"
            . "<input type='button' onclick='eliminar(" . "\"$codigo1\"" . ");' class='btn' "
            . "title='Eliminar Producto' value='Eliminar'/>"
            . "</center>"
            . "</td>";
    $total = 0.00;
    $total = $codigo->getCantidad() * $costoMenudeo;
    $interfaz.="<td><center><input class='form-control' type='text' id='txtTotal" . $codigo->getCodigo() . "'  value='" . $total . "'  /></center></td>";
    $interfaz.="<td><center><input disabled= 'true' class='form-control' type='text' id='txtDescuento" . $codigo->getCodigo() . "' value='0.00' /></center></td>";
    $interfaz.="<td><center><input class='form-control' type='text' id='txtTotalDesc" . $codigo->getCodigo() . "'  value='" . $total . "'  /></center></td>";
    $interfaz.="</tr>";
} else {
//    $interfaz = "";
    $interfaz = 0;
}
echo $interfaz;
?>