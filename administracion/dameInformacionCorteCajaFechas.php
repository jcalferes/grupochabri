<?php
session_start();
$idSucursal = $_SESSION["sucursalSesion"];
include './administracion.dao/dao.php';
$dao = new dao();
$fecha1 = $_GET["fecha1"];
$fecha2 = $_GET["fecha2"];
$rs = $dao->dameTotalXmlComprobanteCorteCajaPorFechas($idSucursal, $fecha1, $fecha2);
$rsAbono = $dao->dameAbonoTotalCorteCajaPorFechas($idSucursal, $fecha1, $fecha2);
$rsNotasCredito = $dao->dameVentasCanceladasNotaCreditoFechas($idSucursal, $fecha1, $fecha2);
$rsPagosDosTipos = $dao->dameInformacionDosTiposPagosFechas($idSucursal, $fecha1, $fecha2);
$totalIngreso = 0.00;
?>
<div id="InformacionDia">
    <div class="panel panel-default">
        <div class="panel-heading"><strong>INFORMACIÓN DEL DÍA <label style="color: red"> &nbsp; <?php echo $fecha1; ?></label> AL <label style="color: red"><?php echo $fecha2; ?> </label></strong></div>
        <div class="panel-body">
            <div>
                <span class="label label-primary">RELACION DE MOVIMIENTOS DE VENTAS :</span>
                <table class="table table-hover">
                    <thead>
                    <th><center>Folio</center></th>
                    <th><center>Fecha</center></th>
                    <th><center>Vendedor</center></th>
                    <th><center>Cliente</center></th>
                    <th><center>Tipo de Pago</center></th>
                    <th><center>Total</center></th>
                    <th><center>Detalle</center></th>
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
                            $idTipoPago = $datos[0];
                            if ($idTipoPago == 1) {
                                $okInformacion = true;
                                ?>
                                <tr>
                                    <td><center><?php echo $datos["folioComprobante"]; ?></center></td>
                                <td><center><?php echo $datos["fechaMovimiento"]; ?></center></td>
                                <td><center><?php echo $datos["usuario"]; ?></center></td>
                                <td><center><?php echo $datos["nombreCliente"]; ?></center></td>
                                <td><center><?php echo $datos["tipoPago"]; ?></center></td>
                                <td><center>$ &nbsp;<?php echo $datos["totalComprobante"]; ?> &nbsp;mxn.</center></td>
                                <td><center><a onclick="mostrarInformacionDetalleVenta2(<?php echo $datos["folioComprobante"]; ?>);"><span class="glyphicon glyphicon-list-alt"></span></a></center></td>
                                <td><center><a target="_blank" href="generarNotaCompra.php?folio=<?php echo $datos["folioComprobante"]; ?>&tipo=7"<span class="glyphicon glyphicon-cloud"></span></a></center></td>                
                                </tr>
                                <?php
                                $totalIngreso = $totalIngreso + $datos["totalComprobante"];
                            }
                        }
                        if ($okInformacion == false) {
                            echo '<tr ><td colspan="8" style="background-color: #edc0c0"><strong>NO HAY MOVIMIENTOS EN ESTE MOMENTO</strong></td></tr>';
                        }
                    }
                    ?>
                </table>
                <span class="label label-primary">RELACION DE MOVIMIENTO DE ABONOS :</span>
                <table class="table table-hover">
                    <thead>
                    <th><center>Folio</center></th>
                    <th><center>Cliente</center></th>
                    <th><center>Saldo</center></th>
                    <th><center>Tipo de Pago</center></th>
                    <th><center>Cantidad Abonada</center></th>
                    <th><center>Detalle</center></th>
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
                            <td><center><a onclick="mostrarInformacionDetalleAbonos(<?php echo $rsAb["folioComprobante"]; ?>,<?php echo $rsAb["statusOrden"]; ?>);"><span class="glyphicon glyphicon-list-alt"></span></a></center></td>
                            <td><center><a target="_blank" href="generarNotaCompra.php?folio=<?php echo $rsAb["folioComprobante"]; ?>&tipo=<?php echo $rsAb["statusOrden"]; ?>"<span class="glyphicon glyphicon-cloud"></span></a></center></td>                        
                            </tr>
                            <?php
                            $totalIngreso = $totalIngreso + $rsAb["importe"];
                        }
                        if ($okInformacion == false) {
                            echo '<tr ><td colspan="7" style="background-color: #edc0c0"><strong>NO HAY MOVIMIENTOS EN ESTE MOMENTO</strong></td></tr>';
                        }
                    }
                    ?>
                </table>
                <span class="label label-primary">RELACION DE VENTAS CANCELADAS CON NOTA DE CREDITO</span>
                <table class="table table-hover">
                    <thead>
                    <th>Folio</th>
                    <th>Cliente</th>
                    <th>Cantidad</th>
                    <th>Detalle</th>
                    </thead>
                    <?php
                    $okCredito = false;
                    if ($rsNotasCredito == false) {
                        ?>
                        <tr>
                            <td colspan="3">
                                <?php echo mysql_error; ?>
                            </td>
                        </tr>
                        <?php
                    } else {

                        while ($rsNotasCr = mysql_fetch_array($rsNotasCredito)) {
                            $okCredito = true;
                            ?>
                            <tr>
                                <td><?php echo $rsNotasCr["folioComprobante"]; ?></td>
                                <td><?php echo $rsNotasCr["nombreCliente"]; ?></td>
                                <td>$ &nbsp;<?php echo $rsNotasCr["totalComprobante"]; ?> mxn.</td>
                                <td><center><a onclick="mostrarInformacionDetalleCancelacionVenta(<?php echo $rsNotasCr["folioComprobante"]; ?>);"><span class="glyphicon glyphicon-list-alt"></span></a></center></td>
                            <td><center><a target="_blank" href="generarNotaCompra.php?folio=<?php echo $rsNotasCr["folioComprobante"]; ?>&tipo=9"<span class="glyphicon glyphicon-cloud"></span></a></center></td>                                   
                            </tr>
                            <?php
                            $totalIngreso = $totalIngreso + $rsNotasCr["totalComprobante"];
                        }
                        if ($okCredito == false) {
                            echo '<tr ><td colspan="5" style="background-color: #edc0c0"><strong>NO HAY MOVIMIENTOS EN ESTE MOMENTO</strong></td></tr>';
                        }
                    }
                    ?>
                </table>
                <span class="label label-primary">RELACION DE VENTAS HECHAS CON NOTA DE CREDITO Y OTRO TIPO DE PAGO</span>
                <table class="table tabe-hover">
                    <thead>
                    <th><center>Folio</center></th>
                    <th><center>Cliente</center></th>
                    <th><center>TipoPago</center></th>
                    <th><center>Total</center></th>
                    <th><center>Detalle</center></th>
                    <th><center>Reporte</center></th>
                    </thead>
                    <?php
                    if ($rsPagosDosTipos == false) {
                        ?>
                        <tr>
                            <td colspan="6">
                                <?php echo mysql_error(); ?>
                            </td>
                        </tr>
                        <?php
                    } else {
                        $informacion2TiposPagos = false;
                        while ($datos2 = mysql_fetch_array($rsPagosDosTipos)) {
                            $informacion2TiposPagos = true;
                            ?>
                            <tr>
                                <td><center><?php echo $datos2["idFolioVenta"]; ?></center></td>
                            <td><center><?php echo $datos2["nombreCliente"]; ?></center></td>
                            <td><center><?php echo $datos2["tipoPago"] ?></center></td>
                            <td><center><?php echo $datos2["monto"]; ?></center></td>
                            <td><center><a onclick="mostrarInformacionDetalleNotaCredito(<?php echo $datos2["folioComprobante"]; ?>);"><span class="glyphicon glyphicon-list-alt"></span></a></center></td>
                            <td><center><a target="_blank" href="generarNotaCompra.php?folio=<?php echo $datos2["folioComprobante"]; ?>&tipo=7"<span class="glyphicon glyphicon-cloud"></span></a></center></td>                       
                            </tr>
                            <?php
                            $totalIngreso = $totalIngreso + $datos2["monto"];
                        }
                        if ($informacion2TiposPagos == false) {
                            echo '<tr ><td colspan="6" style="background-color: #edc0c0"><strong>NO HAY MOVIMIENTOS EN ESTE MOMENTO</strong></td></tr>';
                        }
                    }
                    ?>

                </table>
                <br>
                <label style="color: red">CANTIDAD DE DINERO INGRESADO A LA CAJA :</label><strong> <span id="totalDelDia">$ &nbsp;<?php echo $totalIngreso; ?> &nbsp;mxn.</span></strong>
            </div>
        </div>
    </div>
</div>