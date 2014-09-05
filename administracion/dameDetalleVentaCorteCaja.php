<?php
session_start();
include './administracion.dao/dao.php';
$dao = new dao();
$folioComprobate = $_GET["folio"];
$idSucursal = $_SESSION["sucursalSesion"];
$datos = $dao->dameDetallePedidosFolioComprobante($folioComprobate, $idSucursal);
?>
<table class="table table-hover" id="tablaDetalleCorteCaja">
    <thead>
    <th>Codigo</th>
    <th>Producto</th>
    <th>Cantidad</th>
    <th>Importe</th>
</thead>
<?php
if ($datos == false) {
    ?>
    <tr>
        <td colspan="4">
            <div style="color: red">
                <?php echo mysql_error(); ?>
            </div>
        </td>
    </tr>

    <?php
} else {
    while ($rs = mysql_fetch_array($datos)) {
        ?>
        <tr>
            <td><?php echo $rs["codigoConcepto"]; ?></td>
            <td><?php echo $rs["descripcionConcepto"]; ?></td>
            <td><?php echo $rs["cantidadConcepto"]; ?></td>
            <td><?php echo $rs["importeConcepto"]; ?></td>

        </tr>
        <?php
    }
}
?></table>