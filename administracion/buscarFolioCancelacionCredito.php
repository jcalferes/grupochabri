<?php

session_start();
include './administracion.dao/dao.php';
include_once '../daoconexion/daoConeccion.php';

$foliocancelacion = $_GET["foliocancelacion"];
$idsucursal = $_SESSION["sucursalSesion"];
$dao = new dao();
$cn = new coneccion();

$publico = 0;

$cn->Conectarse();
$datos = $dao->dameInfoCancelacionCredito($foliocancelacion, $idsucursal);
$datosAbonos = $dao->consultarAbonos($foliocancelacion);

if ($datos != false) {

    echo "<table class='table'>";
    while ($rs = mysql_fetch_array($datos)) {
        echo "<tr>";
        echo "<td><label>Folio: </label><span id='spnfolio'>$rs[folioComprobante]</span><br><label>RFC del cliente: </label>$rs[rfcComprobante]";
        echo "<br><label>Nombre del cliente: </label>$rs[nombreCliente]</td>";
        if ($rs["rfcComprobante"] == "0") {
            $publico = 1;
        }
        echo "<td></tr><tr>";
        echo "<td><label>Descuento total: </label>$rs[desctTotalComprobante]</td>";
        echo "<td><label>Total: </label>$rs[totalComprobante]</td></tr>";
        break;
    }
    echo '<div class="alert alert-warning" role="alert"><center><strong>'
    . 'NO HAY DEVOLUCION DEL DINERO DE LOS ABONOS HECHOS POR EL CLIENTE'
    . '</strong></center></div>';
    echo '</br>';

    echo "</table>";
    echo '<br>';
    echo '<div class="checkbox">
    <label>
      <input onchange="cancelarToda();" type="checkbox" id="cancelartodo"/><strong>Cancelar toda la venta.</strong>
    </label>
  </div>';
    mysql_data_seek($datos, 0);
    echo "<div class='well well-sm'>"
    . "<div class='table-responsive'>"
    . "<table class='table table-hover table-condensed' id='dtcancelacion'>"
    . "<thead>"
    . "<th>Devolver</th>"
    . "<th>Codigo</th>"
    . "<th>Descripcion</th>"
    . "<th>Cantidad</th>"
    . "<th>Importe</th>"
    . "</thead>"
    . "<tbody>";

    while ($rs = mysql_fetch_array($datos)) {
        echo "<tr>";
        echo '<td><input id="codigo'.$rs["codigoConcepto"].'"  onchange="seleccionarProductoAEliminar('.$rs["codigoConcepto"] .')"   class="cancel" value="' . $rs["codigoConcepto"] . '" type="checkbox"/></td>';
        echo "<td>$rs[codigoConcepto]</td>";
        echo "<td>$rs[descripcionConcepto]</td>";
        echo "<td><span id='cantidad" . $rs["codigoConcepto"] . "'>$rs[cantidadConcepto]</span></td>";
        echo "<td>$rs[importeConcepto]</td>";
        echo '</tr>';
    }
    echo "</tbody></table></div></div>";
    echo '<br>';
    echo '<strong>MOVIMIENTOS DE PAGOS</stron>';
    echo "<table class='table table-hover'>";
    $totalAbonos = 0.00;
    if ($datosAbonos == 1) {
        echo '<td> hubo un error</td>';
    } else {
        while ($rsC = mysql_fetch_array($datosAbonos)) {
            echo '<tr>';
            echo '<td>' . $rsC["fechaAbono"] . '</td>';
            echo '<td>$' . $rsC["importe"] . '.mxn</td>';
            echo"</tr>";
            $totalAbonos = $totalAbonos + $rsC["importe"];
        }
    }
    echo '<tr>'
    . '<td><strong>Total :</strong></td>'
    . '<td>$' . number_format($totalAbonos, 4) . '.mxn</td>'
    . '</tr>';
    echo "</table>";

    echo "<div class='form-group'><div class='checkbox'><label><input type='checkbox' id='chkreutilizar'>Reeutilizar como una venta</label></div></div>"
    . "<label>Observaciones:</label><br/><textarea class='form-control' id='txaobscancelacion'></textarea><br>";
    if ($publico == 1) {
        echo "<input type='text' id='buzon_rfc' value='$publico' disabled hidden/>";
    }
    echo "<script> $('#divfoliocancelacion').slideUp(); $('#divvalidacancelacion').slideDown();</script>";
} else {
    echo "<script> alertify.error('El folio no existe o no se encontraron datos para el mismo');</script>";
}
?>