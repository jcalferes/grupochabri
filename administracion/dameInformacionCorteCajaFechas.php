<?php
session_start();
$idSucursal = $_SESSION["sucursalSesion"];
include './administracion.dao/dao.php';
$dao = new dao();
$fecha1 = $_GET["fecha1"];
$fecha2 = $_GET["fecha2"];
$rs = $dao->dameTotalXmlComprobanteCorteCajaPorFechas($idSucursal, $fecha1, $fecha2);
$rsAbono = $dao->dameAbonoTotalCorteCajaPorFechas($idSucursal, $fecha1, $fecha2);
?>
<div id="InformacionDia">
    <div class="panel panel-default">
        <div class="panel-heading"><strong>INFORMACIÓN DEL DÍA <label style="color: red"> &nbsp; <?php echo $fecha1; ?></label> AL <label style="color: red"><?php echo $fecha2; ?> </label></strong></div>
        <div class="panel-body">
            <div>
                <strong>Relación de movimiento de VENTAS :</strong>
                <table class="table table-hover">
                    <thead>
                    <th><center>Folio</center></th>
                    <th><center>Cliente</center></th>
                    <th><center>Tipo de Pago</center></th>
                    <th><center>Total</center></th>
                    </thead>
                    <?php
                    if ($rs == false) {
                        ?>
                        <tr>
                            <td>
                        <center>
                            <?php echo mysql_error(); ?>   
                        </center>
                        </td>
                        </tr>
                        <?php
                    } else {
                        $okInformacion = false;
                        while ($datos = mysql_fetch_array($rs)) {
                            $okInformacion = true;
                            ?>
                            <tr>
                                <td><center><?php echo $datos["folioComprobante"]; ?></center></td>
                            <td><center><?php echo $datos["nombreCliente"]; ?></center></td>
                            <td><center><?php echo $datos["tipoPago"]; ?></center></td>
                            <td><center>$ &nbsp;<?php echo $datos["totalComprobante"]; ?> &nbsp;mxn.</center></td>
                            </tr>
                            <?php
                        }
                        if ($okInformacion == false) {
                            echo '<tr ><td colspan="6" style="background-color: #edc0c0"><strong>NO HAY MOVIMIENTOS EN ESTE MOMENTO</strong></td></tr>';
                        }
                    }
                    ?>
                </table>
                <strong>Relación de movimientos de ABONOS :</strong>
                <table class="table table-hover">
                    <thead>
                    <th><center>Folio</center></th>
                    <th><center>Cliente</center></th>
                    <th><center>Saldo</center></th>
                    <th><center>Tipo de Pago</center></th>
                    <th><center>Cantidad Abonada</center></th>
                    </thead>
                    <?php
                    if ($rsAbono == false) {
                        ?>
                        <tr>
                            <td><?php echo mysql_error(); ?></td>
                        </tr>
                        <?php
                    } else {
                        $okInformacion = false;
                        while ($rsAb = mysql_fetch_array($rsAbono)) {
                            $okInformacion = true;
                            ?>
                            <tr>
                                <td><center><?php echo $rsAb["idAbonos"]; ?></center></td>
                            <td><center><?php echo $rsAb["nombre"]; ?></center></td>
                            <td><center><?php echo $rsAb["saldo"]; ?></center></td>
                            <td><center><?php echo $rsAb["tipoPago"]; ?></center></td>
                            <td><center>$ &nbsp;<?php echo $rsAb["importe"]; ?> &nbsp;mxn.</center></td>
                            </tr>
                            <?php
                        }
                        if ($okInformacion == false) {
                            echo '<tr ><td colspan="6" style="background-color: #edc0c0"><strong>NO HAY MOVIMIENTOS EN ESTE MOMENTO</strong></td></tr>';
                        }
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
</div>