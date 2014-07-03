<?php
session_start();
include './administracion.dao/dao.php';
$dao = new dao();
$idSucursal = $_SESSION["sucursalSesion"];
$id = 0;
$id = $_GET["id"];
$datos = true;
$datos = $dao->traerEncabezadoPedios($id, $idSucursal);
if ($datos == false) {
    echo mysql_error();
}
$cliente = 0;
$xmlComprobante = 0;
while ($rs = mysql_fetch_array($datos)) {
    $xmlComprobante = $rs["idXmlComprobante"];
    $cliente = $rs["rfcComprobante"];
    $fecha = "";
    $tipopago = "";
    $fecha = $rs["fechaComprobante"];
    $tipopago = $rs["tipoPago"];
    if ($cliente == "0") {
        $cliente = "Venta al Publico";
    }
    ?>
    <div class="well">
        <span style="display: none" id="xmlComprobante"><?php echo $rs["idXmlComprobante"];?></span>
        <strong>Folio : <span id="folioPagar"><?php echo $rs["folioComprobante"];?></span></strong>
        <br/>
        <strong>Venta : <?php echo $cliente; ?></strong>
        <strong style="float: right"> <?php echo $fecha; ?></strong>
        <br>
        <strong>Tipo Pago : <?php echo $tipopago; ?></strong>
    </div>   
    <br>
    <table class="table table-hover">
        <thead>
        <th><center>Codigo</center></th>
    <th><center>Descripcion</center></th>
    <th><center>Cantidad</center></th>
    <th><center>Precio</center></th>
    <th><center>SubTotal</center></th>
    <th><center>Descuentos</center></th>
    <th><center>Total</center></th>
    </thead>
    <?php
    $rs1 = $dao->dameDetallePedidos($xmlComprobante);
    if ($rs1 == false) {
        echo mysql_error();
    } else {
        while ($datos1 = mysql_fetch_array($rs1)) {
            ?>
            <tr>
                <td>
                    <?php echo $datos1["codigoConcepto"]; ?>
                </td>
                <td>
            <center><?php echo $datos1["descripcionConcepto"]; ?></center>
            </td>
            <td>
            <center>  <?php echo $datos1["cantidadConcepto"]; ?></center>
            </td>
            <td>
            <center><?php echo $datos1["precioUnitarioConcepto"]; ?></center> 
            </td>
            <td>
            <center> <?php echo ($datos1["precioUnitarioConcepto"] * $datos1["cantidadConcepto"]); ?></center>
            </td>
            <td>
            <center> <?php echo intval($datos1["desctUnoConcepto"]); ?>%</center>
            </td>
            <td>
            <center> <?php echo $datos1["cdaConcepto"]; ?></center>
            </td>
            </tr>
            <?php
        }
    }
    ?>
    </table>
    <div style="float: right">
        <table style="width: 180px">
            <tr>
                <td>Subtotal :</td>
                <td><?php echo $rs["subtotalComprobante"]; ?></td>
            </tr>
            <tr>
                <td>IVA :</td>
                <td><?php echo $rs["ivaComprobante"]; ?></td>
            </tr>
            <tr>
                <td><strong>Total</strong></td>
                <td><strong><span id="totalV"><?php echo $rs["totalComprobante"]; ?></span></strong></td>
            </tr>
        </table>
    </div>
    <?php
}
?>
