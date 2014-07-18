<?php
include './administracion.dao/dao.php';
$dao = new dao();
$id = $_GET["id"];
$datos = $dao->dameTotalesXmlComprobantes($id);
if ($datos == false) {
    echo mysql_error();
} else {
    while ($rs = mysql_fetch_array($datos)) {
        ?>
        <div id="contenedorTotales">
            <form class="form-inline text-right">
                <span>Sub Total : <input value="<?php echo $rs["subtotalComprobante"]; ?>" type="text" id="subTotalV" class="form-control text-right" style="width: 20%" disabled="true"/></span>
            </form>
            <form class="form-inline text-right" style="margin-top: 5px">
                <span>Desc. Total : <input value="<?php echo $rs["desctTotalComprobante"]; ?>" type="text" id="descTotalV" class="form-control text-right" style="width: 20%" disabled="true"/></span>
            </form>
            <form class="form-inline text-right" style="margin-top: 5px">
                <span>SDA :<input value="<?php echo $rs["sdaComprobante"]; ?>" type="text" id="costoTotal" class="form-control text-right" style="width: 20%" disabled="true"/></span>
            </form>
            <!--<br>-->
            <form class="form-inline text-right" style="margin-top: 5px">
                <span>IVA : <input value="<?php echo $rs["ivaComprobante"]; ?>" type="text" id="ivaTotal" class="form-control text-right" style="width: 20%" disabled="true"/></span>
            </form>
            <!--                <br>-->
            <form class="form-inline text-right" style="margin-top: 5px">
                <span>Total : <input value="<?php echo $rs["totalComprobante"]; ?>" type="text" id="totalVenta" class="form-control text-right" style="width: 20%" disabled="true"/></span>
            </form>
        </div>
        <?php
    }
}