<?php

session_start();
include './administracion.dao/dao.php';
include './administracion.clases/Codigo.php';
$dao = new dao();
$codigo = new Codigo();
$idXmlComprobante = $_GET["id"];
$rs = $dao->dameOrdenCompraDetalle($idXmlComprobante);
$existenciaTemporal = 0;
$datosTemp = false;
$idSucursal = $_SESSION["sucursalSesion"];
$existenciasFisicas = 0;
$costoProducto = 0.00;
if ($datosTemp == false) {
    $existenciaTemporal = 0;
}
if ($rs == false) {
    echo mysql_error();
} else {
    echo '<table>';
    echo '<thead>';
    echo '<th>Codigo</th>';
    echo '<th>Descripcion</th>';
    echo '<th>Cantidad</th>';
    echo '<th>Existencia</th>';
    echo '<th>Lst. Precio</th>';
    echo '<th>Precio c/u</th>';
    echo '<th>Desc</th>';
    echo '<th>Eliminar</th>';
    echo '<th>total</th>';
    echo '<th>$ Desc.</th>';
    echo '<th>Total c/d.</th>';
    echo '</thead>';
    while ($datos = mysql_fetch_array($rs)) {
//---------------------------------------------
        $codigo1 = "";
        $codigo1 = $datos["codigoConcepto"];
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
//--------------------------------------------------
        $costoProducto = $datos["importeConcepto"];
        $rsDatosTemporal = $dao->dameExistenciaTemporal($datos["codigoConcepto"], $idSucursal);
        if ($rsDatosTemporal == false) {
            echo mysql_error();
            break;
        } else {
            while ($datosT = mysql_fetch_array($rsDatosTemporal)) {
                $datosTemp = true;
                $existenciaTemporal = $datosT[0];
            }
        }
        $rsExistenFi = $dao->dameExistenciaFisica($datos["codigoConcepto"], $idSucursal);
        if ($rsExistenFi == false) {
            echo mysql_error();
            break;
        } else {
            while ($rsExitFisica = mysql_fetch_array($rsExistenFi)) {
                $existenciasFisicas = $rsExitFisica[0];
            }
        }
        $codigo->setCodigo($datos["codigoConcepto"]);
        $cod = "";
        $cod = $codigo->getCodigo();
        $existenciaReal = $existenciasFisicas - $existenciaTemporal;
        $totalSinDescuento = 0;
        $totalSinDescuento = $datos["cantidadConcepto"] * $datos["precioUnitarioConcepto"];
        $dineroDescuento = $totalSinDescuento - $datos["cdaConcepto"];
        $dineroDescuento = round($dineroDescuento, 2);
        echo '<tr id="tr' . $codigo->getCodigo() . '">';
        echo '<td>';
        echo '<span id="codigo' . $codigo->getCodigo() . '">' . $datos["codigoConcepto"] . '</span>';
        echo '</td>';
        echo '<td>';
        echo $datos["descripcionConcepto"];
        echo '</td>';
        echo '<td style="width: 150px">';
        if ($paso == false) {
            echo "<input id='txt" . $codigo->getCodigo() . "' type ='text' value= '" . $datos["cantidadConcepto"] . "' class='form-control'  onkeyup='calcularTotal(" . "\"$cod\"" . ")'/>";
        } else {
            echo"<div class='input-group'>
                         <input type='text' id='txt" . $codigo->getCodigo() . "' 
                             class='form-control' placeholder='Cant. Kg'
                             onkeyup='calcularTotal(" . "\"$codigo1\"" . ")'
                             value='" . $datos["cantidadConcepto"] . "'/>
                         <span class='input-group-btn'>
                            <button class='btn btn-default' type='button' onclick='modalProductosGranel(" . "\"$codigo1\"" . ")'>
                                <span class='glyphicon glyphicon-plus'></span>
                             </button>
                          </span>
                       </div>";
        }
        echo '</td>';
        echo '<td>';
        echo '<span id="txtExistencia' . $codigo->getCodigo() . '"><center>' . $existenciaReal . '</center></span>';
        echo '</td>';
        echo '<td>';

        $rsTarifas = $dao->dameTarifas($codigo, $idSucursal);
        if ($rsTarifas == false) {
            echo mysql_error();
            break;
        }
        echo "<select id='cmb" . $codigo->getCodigo() . "' class='form-control autorizar' disabled='true' onchange='cambiarTarifas(" . "\"$cod\"" . ");'>";
        $costoVenta = 0.00;
        while ($rTarifas = mysql_fetch_array($rsTarifas)) {
            $costo = $rTarifas["costo"];
            $utilidad = $rTarifas["porcentaUtilidad"];
            $costoPublico = ($costo * (1 + ($utilidad / 100)));
            $idListaPrecio = 0;
            $idListaPrecio = $datos["idListaPrecio"];
            $select = false;
            if ($rTarifas["idListaPrecio"] == $idListaPrecio) {
                $select = true;
            }
            echo '<option ';
            if ($select == true) {
                echo 'selected="true"';
            }
            echo' value = "' . $rTarifas[0] . ',' . ($costoPublico * 1.16) . ' ">';
            echo $rTarifas[1];
            echo '</option>';
        }
        echo'</select>';
        echo '</td>';
        echo '<td>';
        echo '<span id ="precioVnt' . $codigo->getCodigo() . '">' . $datos["precioUnitarioConcepto"] . '</span>';
        echo '</td>';
        echo '<td>';
        echo "<input  onkeyup='calcularDescuentos(" . "\"$cod\"" . ")' disabled='true'     class='form-control autorizar' style='width:60px' id ='txtDescuentos" . $codigo->getCodigo() . "' type='text' value ='" . $datos["desctUnoConcepto"] . "'/>";
        echo '</td>';
        echo '<td>';
        echo "<input type='button' onclick='eliminar(" . "\"$cod\"" . ")' class='btn botonEliminar' title='Eliminar Producto' value='Eliminar'>";
        echo '</td>';
        echo '<td>';
        echo '<input disabled="true" class="form-control" type="text" id="txtTotal' . $codigo->getCodigo() . '" value="' . $totalSinDescuento . '"/>';
        echo '</td>';
        echo '<td>';
        echo '<input disabled="true" class="form-control" '
        . 'type="text" id="txtDescuento' . $codigo->getCodigo() . '" '
        . 'value= "' . $dineroDescuento . '"/>';
        echo '</td>';
        echo '<td>';
        echo '<input disabled="true" class="form-control" type="text" id="txtTotalDesc' . $codigo->getCodigo() . '" value="' . $datos["cdaConcepto"] . '">';
        echo '</td>';
        echo '</tr>';
    }
    echo '</table>';
}
