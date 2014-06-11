<?php

include './administracion.dao/dao.php';
$dao = new dao();
//$rfc = "";
//$rfc = $_GET["rfc"];
//$datos = $dao->verificarCredito($rfc);
//if ($dao == false) {
//    echo '<select>'
//    . '<option>' . mysql_error() . '</option>'
//    . '</select>';
//} else {
//    $credito = 0;
//    while ($rs = mysql_fetch_array($datos)) {
//        $credito = $rs[0];
//    }
    $datosTipos = $dao->dameTiposPagos();
    echo '<select class="form-control" id="cmbTipoPago">';
    while ($rsTipos = mysql_fetch_array($datosTipos)) {
        if ($credito > 0 && $rsTipos[0] == 2) {
            echo '<option value="' . $rsTipos[0] . '">' . $rsTipos[1] . '</option>';
        } else {
            echo '<option value="' . $rsTipos[0] . '">' . $rsTipos[1] . '</option>';
        }
    }
    echo '</select>';
//}

