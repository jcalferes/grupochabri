<?php

session_start();
include './administracion.dao/dao.php';
$dao = new dao();
$idXmlComprobante = $_GET["id"];
$rs = $dao->dameOrdenCompraDetalle($idXmlComprobante);
$existenciaTemporal = 0;
$datosTemp = false;
$idSucursal = $_SESSION["sucursalSesion"];
$existenciasFisicas =0;
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
                $existenciasFisicas = $rsExitFisica["existencias"];
            }
        }
        $existenciaReal = $existenciasFisicas-$existenciaTemporal;
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
        echo $datos["codigoConcepto"];
        echo '</td>';
        echo '<td>';
        echo $datos["codigoConcepto"];
        echo '</td>';
        echo '<td>';
        echo $datos["codigoConcepto"];
        echo '</td>';
        echo '<td>';
        echo $datos["codigoConcepto"];
        echo '</td>';
        echo '<td>';
        echo $datos["codigoConcepto"];
        echo '</td>';
        echo '<td>';
        echo $datos["codigoConcepto"];
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
