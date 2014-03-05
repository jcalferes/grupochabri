<?php

include './administracion.clases/Detalle.php';
include './administracion.clases/Encabezado.php';
include './administracion.clases/Comprobante.php';
include './administracion.clases/Concepto.php';
session_start();
//Como no sabemos cuantos archivos van a llegar, iteramos la variable $_FILES
$ruta = "../subidas/";
foreach ($_FILES as $key) {
    if ($key['error'] == UPLOAD_ERR_OK) {//Verificamos si se subio correctamente
        $nombre = $key['name']; //Obtenemos el nombre del archivo
        $temporal = $key['tmp_name']; //Obtenemos el nombre del archivo temporal
        move_uploaded_file($temporal, $ruta . $nombre); //Movemos el archivo temporal a la ruta especificada
        //El echo es para que lo reciba jquery y lo ponga en el div "cargados"
    } else {
        echo $key['error']; //Si no se cargo mostramos el error
    }
}
$archivo = $ruta . $nombre;
$xml = simplexml_load_file($archivo);
$ns = $xml->getNamespaces(true);
$xml->registerXPathNamespace('c', $ns['cfdi']);
$xml->registerXPathNamespace('t', $ns['tfd']);
$encabezadoEntrada = new Encabezado();

$detalle = new Detalle();
$concepto = new Concepto();

echo "<span class='label label-default'>Comprobante </span>";
echo "<blockquote>";
echo "<div class='table-responsive'>";
echo "<table class='table table-hover'>";
echo "<thead>";
echo "<th>Version</th><th>Folio</th><th>Fecha</th><th>Total</th><th>Subtotal</th><th>Forma de Pago</th><th>No. Certificado</th><th>Tipo Comprobante</th>";
echo "</thead>";
echo "<tbody>";
foreach ($xml->xpath('//cfdi:Comprobante') as $cfdiComprobante) {
    echo "<tr>";
    echo "<td>" . $cfdiComprobante['version'] . "</td>";
    echo "<td>" . $cfdiComprobante['folio'] . "</td>";
    echo "<td>" . $cfdiComprobante['fecha'] . "</td>";
    echo "<td>" . $cfdiComprobante['total'] . "</td>";
    echo "<td>" . $cfdiComprobante['subTotal'] . "</td>";
    echo "<td>" . $cfdiComprobante['formaDePago'] . "</td>";
    echo "<td>" . $cfdiComprobante['noCertificado'] . "</td>";
    echo "<td>" . $cfdiComprobante['tipoDeComprobante'] . "</td>";
    echo "</tr>";
    $encabezadoEntrada->setFolio(utf8_decode($cfdiComprobante['folio']));
    $encabezadoEntrada->setFecha(utf8_decode($cfdiComprobante['fecha']));
    $encabezadoEntrada->setTotal(utf8_decode($cfdiComprobante['total']));
    $encabezadoEntrada->setSubtotal(utf8_decode($cfdiComprobante['subTotal']));
}
echo "</tbody>";
echo "</table>";
echo "<div >";
echo "</blockquote>";

echo "<span class='label label-default'>Emisor </span>";
echo "<blockquote>";
echo "<table class='table table-hover'>";
echo "<thead>";
echo "<th>RFC</th><th>Nombre</th>";
echo "</thead>";
echo "<tbody>";
foreach ($xml->xpath('//cfdi:Comprobante//cfdi:Emisor') as $Emisor) {
    echo "<tr>";
    echo "<td><span id='facrfc'>" . $Emisor['rfc'] . "</span></td>";
    echo "<td>" . $Emisor['nombre'] . "</td>";
    echo "</tr>";
    $encabezadoEntrada->setRfc(utf8_decode($Emisor['rfc']));
}
echo "</tbody>";
echo "</table>";
echo "</blockquote>";

echo "<span class='label label-default'>Dimicilio Fiscal </span>";
echo "<blockquote>";
echo "<table class='table table-hover'>";
echo "<thead>";
echo "<th>Pais</th><th>Calle</th><th>Estado</th><th>Colonia</th><th>Municipio</th><th>No. Exterior</th><th>Codigo Postal</th>";
echo "</thead>";
echo "<tbody>";
foreach ($xml->xpath('//cfdi:Comprobante//cfdi:Emisor//cfdi:DomicilioFiscal') as $DomicilioFiscal) {
    echo "<tr>";
    echo "<td>" . $DomicilioFiscal['pais'] . "</td>";
    echo "<td>" . $DomicilioFiscal['calle'] . "</td>";
    echo "<td>" . $DomicilioFiscal['estado'] . "</td>";
    echo "<td>" . $DomicilioFiscal['colonia'] . "</td>";
    echo "<td>" . $DomicilioFiscal['municipio'] . "</td>";
    echo "<td>" . $DomicilioFiscal['noExterior'] . "</td>";
    echo "<td>" . $DomicilioFiscal['codigoPostal'] . "</td>";
    echo "</tr>";
}
echo "</tbody>";
echo "</table>";
echo "</blockquote>";

//echo "<span class='label label-default'>Expedido en </span>";
//echo "<blockquote>";
//echo "<table class='table table-hover'>";
//echo "<thead>";
//echo "<th>Pais</th><th>Calle</th><th>Estado</th><th>Colonia</th><th>No. Exterior</th><th>Codigo Postal</th>";
//echo "</thead>";
//echo "<tbody>";
//foreach ($xml->xpath('//cfdi:Comprobante//cfdi:Emisor//cfdi:ExpedidoEn') as $ExpedidoEn) {
//    echo "<tr>";
//    echo "<td>" . $ExpedidoEn['pais'] . "</td>";
//    echo "<td>" . $ExpedidoEn['calle'] . "</td>";
//    echo "<td>" . $ExpedidoEn['estado'] . "</td>";
//    echo "<td>" . $ExpedidoEn['colonia'] . "</td>";
//    echo "<td>" . $ExpedidoEn['noExterior'] . "</td>";
//    echo "<td>" . $ExpedidoEn['codigoPostal'] . "</td>";
//    echo "</tr>";
//}
//echo "</tbody>";
//echo "</table>";
//echo "</blockquote>";
//echo "<span class='label label-default'>Receptor </span>";
//echo "<blockquote>";
//echo "<table class='table table-hover'>";
//echo "<thead>";
//echo "<th>RFC</th><th>Nombre</th>";
//echo "</thead>";
//echo "<tbody>";
//foreach ($xml->xpath('//cfdi:Comprobante//cfdi:Receptor') as $Receptor) {
//    echo "<tr>";
//    echo "<td>" . $Receptor['rfc'] . "</td>";
//    echo "<td>" . $Receptor['nombre'] . "</td>";
//    echo "</tr>";
//}
//echo "</tbody>";
//echo "</table>";
//echo "</blockquote>";
//echo "<span class='label label-default'>Domicilio del receptor </span>";
//echo "<blockquote>";
//echo "<table class='table table-hover'>";
//echo "<thead>";
//echo "<th>Pais</th><th>Calle</th><th>Estado</th><th>Colonia</th><th>Municipio</th><th>No Exterior</th><th>No Interior</th><th>Codiogo Postal</th>";
//echo "</thead>";
//echo "<tbody>";
//foreach ($xml->xpath('//cfdi:Comprobante//cfdi:Receptor//cfdi:Domicilio') as $ReceptorDomicilio) {
//    echo "<tr>";
//    echo "<td>" . $ReceptorDomicilio['pais'] . "</td>";
//    echo "<td>" . $ReceptorDomicilio['calle'] . "</td>";
//    echo "<td>" . $ReceptorDomicilio['estado'] . "</td>";
//    echo "<td>" . $ReceptorDomicilio['colonia'] . "</td>";
//    echo "<td>" . $ReceptorDomicilio['municipio'] . "</td>";
//    echo "<td>" . $ReceptorDomicilio['noExterior'] . "</td>";
//    echo "<td>" . $ReceptorDomicilio['noInterior'] . "</td>";
//    echo "<td>" . $ReceptorDomicilio['codigoPostal'] . "</td>";
//    echo "</tr>";
//}
//echo "</tbody>";
//echo "</table>";
//echo "</blockquote>";

echo "<span class='label label-default'>Concepto </span>";
echo "<blockquote>";

echo "<div class='checkbox-inline'>";
echo "<label>";
echo "<input type='checkbox' id='chk' onclick='chkExtras()'/> Descuentos globales de factura";
echo "</label>";
echo "</div>";

echo "<form class='form-inline'>";
echo "<span>Desct. Factura: </span><input type='text' disabled='false' class='form-control' id='descuentoFactura'  onkeyup='calculaPF()' style='width: 15%'/>";
echo "<span> Desct. Pronto Pago: </span><input type='text' disabled='false' class='form-control' id='descuentoProntoPago' onkeyup='calculaPP()' style='width: 15%' />";
echo "<span> Flete: </span><input type='text' disabled='false' class='form-control' id='flete' onkeyup='calculaflete()' style='width: 15%'/>";
echo "</form>";
echo "<hr>";

echo "<div class='checkbox-inline'>";
echo "<label>";
echo "<input type='checkbox' id='chkpp' onclick='chkPP()'/> Descuentos por producto";
echo "</label>";
echo "</div>";

echo "<table id='tblconceptos' class='table table-hover'>";
echo "<thead>";
echo "<th>Cantidad</th><th>Unidad</th><th>Codigo<button type='button' class='btn btn-xs btn-default' id='btnbuscar' onclick='test()' data-toggle='modal' data-target='#mdlconsultaid'><span class='glyphicon glyphicon-search'></span></button></th><th>Descripcion</th><th>Costo</th><th>Desct. 1</th><th>Desct. 2</th><th>Desct. Total</th><th>CDAP</th><th>CDAD</th><th>Importe</th><th>Importe Flete</th>";
//<th>Unidad</th>
echo "</thead>";
echo "<tbody>";
$arrayDetalleEntrada = [];
$cont = 0;
$cuentaid = 0;
foreach ($xml->xpath('//cfdi:Comprobante//cfdi:Conceptos//cfdi:Concepto') as $Concepto) {
    echo "<tr>";
    echo "<td><input type='text' class='form-control' id='cantidad$cuentaid' disabled='false' value='" . $Concepto['cantidad'] . "' /></td>";
    echo "<td>" . $Concepto['unidad'] . "</td>";
    echo "<td><input type='text' class='form-control' id='id$cuentaid'  value='" . $Concepto['noIdentificacion'] . "' /></td>";
    echo "<td>" . $Concepto['descripcion'] . "</td>";
    echo "<td><input type='text' class='form-control' id='valorunitario$cuentaid' disabled='false' value='" . $Concepto['valorUnitario'] . "' /></td>";
    echo "<td><input type='text' maxlength='6' class='form-control' id='unodct$cuentaid' disabled='false' onkeyup=' dameValorDescuento1($cuentaid)' /></td>";
    echo "<td><input type='text' maxlength='6' class='form-control' id='dosdct$cuentaid'  disabled='false' onkeyup='dameValorDescuento2($cuentaid)' /></td>";
    echo "<td><input type='text' class='form-control' value='0.00' id='totaldct$cuentaid' disabled='false'/></td>";
    echo "<td><input type='text' class='form-control' id='cda$cuentaid' disabled='false' value='" . $Concepto['valorUnitario'] . "' /></td>";
    $cantidad = floatval($Concepto['cantidad']);
    $importe = floatval($Concepto['importe']);
    $cdao = number_format($importe / $cantidad, 2, '.', '');
    echo "<td><input type='text' class='form-control' id='cdao$cuentaid' disabled='false' value='$cdao' /></td>";
    echo "<td><input type='text' class='form-control' id='importe$cuentaid' disabled='false' value='" . $Concepto['importe'] . "' /></td>";
    echo "<td><input type='text' class='form-control' id='impoteflete$cuentaid' disabled='false' value='" . $Concepto['importe'] . "' /></td>";
    echo "</tr>";

    $detalle->setUnidadmedida(utf8_decode($Concepto['unidad']));

    $detalle->setImporte(utf8_decode($Concepto['importe']));

    $detalle->setCantidad(utf8_decode($Concepto['cantidad']));

    $detalle->setCodigo(utf8_decode($Concepto['noIdentificacion']));

    $detalle->setDescripcion(utf8_decode($Concepto['descripcion']));

    $detalle->setCosto(utf8_decode($Concepto['valorUnitario']));


    $arrayDetalleEntrada[$cont] = $detalle;
    $detalle = new Detalle();
    $cont++;
    $cuentaid++;
}
echo "<input id='control' type='hidden' value='" . $cont . "' />";
echo "</tbody>";
echo "</table>";
$importe = 0;
foreach ($arrayDetalleEntrada as $detalle) {
    $importe += $detalle->getImporte();
}
$coniva = $importe * 0.16;
$total = $importe + $coniva;
$fimporte = number_format($importe, 2, '.', '');
$fconiva = number_format($coniva, 2, '.', '');
$ftotal = number_format($total, 2, '.', '');
echo "<form class='form-inline text-right'>";
echo "<span> Subtotal: </span><input type='text' class='form-control text-right' id='subzero' disabled='false' style='width: 20%' value='" . $fimporte . "'/>";
echo "</form>";
echo "<br>";
echo "<form class='form-inline text-right'>";
echo "<span> Desct. General: </span><input type='text' class='form-control text-right' id='descuentogeneral' disabled='false' style='width: 20%' value='0.00'/>";
echo "<span> Desct. Prodcutos: </span><input type='text' class='form-control text-right' id='descuentoporproductos' disabled='false' style='width: 20%' value='0.00'/>";
echo "<span> Desct. Total: </span><input type='text' class='form-control text-right' id='sumadescuentos' disabled='false' style='width: 20%' value='0.00'/>";
echo "</form>";
echo "<form class='form-inline text-right'>";
echo "<br>";
echo "<span> SDA: </span><input type='text' class='form-control text-right' id='subtotal' disabled='false' style='width: 20%' value='" . $fimporte . "'/>";
echo "</form>";
echo "<br>";
echo "<form class='form-inline text-right'>";
echo "<span> IVA 16%: </span><input type='text' class='form-control text-right' id='coniva' disabled='false' style='width: 20%' value='" . $fconiva . "'/>";
echo "</form>";
echo "<br>";
echo "<form class='form-inline text-right'>";
echo "<span> Total: </span><input type='text' class='form-control text-right' id='total' disabled='false' style='width: 20%' value='" . $ftotal . "'/>";
echo "</form>";
echo "</blockquote>";

echo "<span class='label label-default'>Traslado </span>";
echo "<blockquote>";
echo "<table class='table table-hover'>";
echo "<thead>";
echo "<th>Tasa</th><th>Importe</th><th>Impuesto</th>";
echo "</thead>";
echo "<tbody>";
foreach ($xml->xpath('//cfdi:Comprobante//cfdi:Impuestos//cfdi:Traslados//cfdi:Traslado') as $Traslado) {
    echo "<tr>";
    echo "<td>" . $Traslado['tasa'] . "</td>";
    echo "<td>" . $Traslado['importe'] . "</td>";
    echo "<td>" . $Traslado['impuesto'] . "</td>";
    echo "</tr>";
}
echo "</tbody>";
echo "</table>";
echo "</blockquote>";

//echo "<span class='label label-default'>Timbre Fiscal </span>";
//echo "<blockquote>";
//echo "<table class='table table-hover'>";
//echo "<thead>";
//echo "<th>Fecha de Timbrado</th><th>UUID</th><th>No. Certificado SAT</th><th>Version</th>";
//echo "</thead>";
//echo "<tbody>";
//foreach ($xml->xpath('//t:TimbreFiscalDigital') as $tfd) {
//    echo "<tr>";
//    echo "<td>" . $tfd['FechaTimbrado'] . "</td>";
//    echo "<td>" . $tfd['UUID'] . "</td>";
//    echo "<td>" . $tfd['noCertificadoSAT'] . "</td>";
//    echo "<td>" . $tfd['version'] . "</td>";
//    echo "</tr>";
//}
//echo "</tbody>";
//echo "</table>";
//echo "</blockquote>";

$_SESSION['objEncabezadoEntrada'] = $encabezadoEntrada;
$_SESSION['arrayDetalleEntrada'] = $arrayDetalleEntrada;

unlink($archivo);

