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
        $cod= $codigo->getCodigo();
        $existenciaReal = $existenciasFisicas - $existenciaTemporal;
        echo '<tr>';
        echo '<td>';
        echo $datos["codigoConcepto"];
        echo '</td>';
        echo '<td>';
        echo $datos["descripcionConcepto"];
        echo '</td>';
        echo '<td>';
        echo '<input type ="text" value= "' . $datos["cantidadConcepto"] . '" class="form-control"/>';
        echo '</td>';
        echo '<td>';
        echo '<span id="txtExistencia' . $codigo->getCodigo() . '">' . $existenciaReal . '</span>';
        echo '</td>';
        echo '<td>';

        $rsTarifas = $dao->dameTarifas($codigo, $idSucursal);
        if ($rsTarifas == false) {
            echo mysql_error();
            break;
        }
        echo "<select class='form-control' onchange='cambiarTarifas(" . "\"$cod\"" . ");'>";
        $costoVenta = 0.00;
        while ($rTarifas = mysql_fetch_array($rsTarifas)) {
            $select = false;
            if ($rTarifas[1] == $datos["idListaPrecio"]) {
                $select = true;
            }
            echo '<option selected="' . $select . '" value = "' . $rTarifas[0] . ',' . $datos["precioUnitarioConcepto"] . ' ">';
            echo $rTarifas[1];
            echo '</option>';
        }
        echo'</select>';
        echo '</td>';
        echo '<td>';
        echo '<span id ="precioVnt' . $codigo->getCodigo() . '">' . $datos["precioUnitarioConcepto"] . '</span>';
        echo '</td>';
        echo '<td>';
        echo '<input class="form-control" style="width:60px" id ="txtDescuentos' . $codigo->getCodigo() . '" type="text" value ="' . $datos["desctUnoConcepto"] . '"</>';
        echo '</td>';
        echo '<td>';
        echo "<input type='button' onclick='eliminar(" . "\"$cod\"" . ")' class='btn' title='Eliminar Producto' value='Eliminar'>";
        echo '</td>';
        echo '<td>';
        echo '<input disabled="true" class="form-control" type="text" id="txtTotal'.$codigo->getCodigo().'" value="'.$datos["cdaConcepto"].'">';
        echo '</td>';
        echo '<td>';
        echo $datos["codigoConcepto"];
        echo '</td>';
        echo '<td>';
        echo $datos["codigoConcepto"];
        echo '</td>';
        echo '</tr>';
    }
    echo '</table>';
}
