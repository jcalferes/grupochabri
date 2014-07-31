<?php
session_start();
$idSucursal = $_SESSION["sucursalSesion"];
include './administracion.dao/dao.php';
$dao = new dao();
$rs = $dao->dameTotalXmlComprobanteCorteCaja($idSucursal);
$rsAbono = $dao->dameAbonoTotalCorteCaja($idSucursal);
?>

<div id="InformacionDia">
    <strong>Relación de movimiento de VENTAS :</strong>
    <table class="table table-hover">
        <thead>
        <th><center>Folio</center></th>
        <th><center>Saldo</center></th>
        <th><center>2</center></th>
        <th><center>3</center></th>
        <th><center>Tipo de Pago</center></th>
        <th><center>Total</center></th>
        </thead>
        <?php
        if ($rs == false) {
            ?>
            <tr>
                <td><?php echo mysql_error(); ?></td>
            </tr>
            <?php
        } else {
            while ($datos = mysql_fetch_array($rs)) {
                ?>
                <tr>
                    <td><?php echo $datos["folioComprobante"]; ?></td>
                    <td>0</td>
                    <td>2</td>
                    <td>3</td>
                    <td><?php echo $datos["tipoPago"]; ?></td>
                    <td>$ &nbsp;<?php echo $datos["totalComprobante"]; ?> &nbsp;mxn.</td>
                </tr>
                <?php
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
        <th><center>1</center></th>
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
            while ($rsAb = mysql_fetch_array($rsAbono)) {
                ?>
                <tr>
                    <td><?php echo $rsAb["idAbonos"]; ?></td>
                    <td><?php echo $rsAb["nombre"]; ?></td>
                    <td><?php echo $rsAb["saldo"]; ?></td>

                    <td>3</td>
                    <td><?php echo $rsAb["tipoPago"]; ?></td>
                    <td>$ &nbsp;<?php echo $rsAb["importe"]; ?> &nbsp;mxn.</td>
                </tr>
                <?php
            }
        }
        ?>
    </table>

</div>