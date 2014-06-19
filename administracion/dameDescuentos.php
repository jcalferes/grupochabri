<?php
include_once './administracion.dao/dao.php';
$dao = new dao();
$rfc = $_GET["rfc"];
$rs = $dao->dameDescuentosClientes($rfc);
if ($rs == true) {
    while ($datos = mysql_fetch_array($rs)) {
        ?>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-1 control-label">Desc. Factura</label>
            <div class="col-sm-1">
                <input type="text" class="form-control" id="inputEmail3"  value="<?php echo $datos["descuentoPorFactura"]; ?>"/>
            </div>
            <label for="inputEmail3" class="col-sm-2 control-label" style="margin-left: -80px">Desc. Pront.Pag </label>
            <div class="col-sm-1">
                <input type="text"  value="<?php echo $datos["descuentoPorProntoPago"]; ?>" class="form-control" id="inputEmail3" />
            </div>
        </div>

        <?php
    }
} else {
    echo mysql_error();
}