<?php
session_start();
include_once './administracion.dao/dao.php';
$codigoProducto = $_GET["id"];
$idSucursal = $_SESSION["sucursalSesion"];
$dao = new dao();
$existenciaTemp = 0;
$existenciaFisica = 0;
$rs = $dao->dameExistenciaTemporal($codigoProducto, $idSucursal);
$rsExistenciaFisica = $dao->dameExistenciaFisica($codigoProducto, $idSucursal);
if ($rs == false || $rsExistenciaFisica == false) {
    echo "<span>" . mysql_error() . "</span>";
} else {
    while ($r = mysql_fetch_array($rs)) {
        $existenciaTemp = $r["cantidad"];
    }
    while (($r2 = mysql_fetch_array($rsExistenciaFisica))) {
        $existenciaFisica = $r2[0];
    }
}

$nuevaExistencia = $existenciaFisica - $existenciaTemp;
if($nuevaExistencia <0){
    $nuevaExistencia=0;
}
?>
<strong><span id="txtExistencia<?php echo $codigoProducto; ?> "style="color: red"><?php echo $nuevaExistencia ?></span></strong>
