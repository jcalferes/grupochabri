<?php

include './administracion.dao/dao.php';
$dao = new dao();
$credito = 0;
$datosTipos = $dao->dameTiposPagos();
echo '<select class="form-control" id="cmbTipoPago">';
while ($rsTipos = mysql_fetch_array($datosTipos)) {
    if ($rsTipos[0] != 7) {
        if ($credito > 0 && $rsTipos[0] == 2) {
            echo '<option value="' . $rsTipos[0] . '">' . $rsTipos[1] . '</option>';
        } else {
            echo '<option value="' . $rsTipos[0] . '">' . $rsTipos[1] . '</option>';
        }
    }
}
echo '</select>';
//}

