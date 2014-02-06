<?php

include './administracion.clases/Detalle.php';
include './administracion.clases/Encabezado.php';
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

echo "<span class='label label-default'>Comprobante </span>";
echo "<blockquote>";
echo "<div class='table-responsive'>";
echo "<table class='table table-hover'>";
echo "<thead>";
echo "<th>Version</th><th>Fecha</th><th>Total</th><th>Subtotal</th><th>Forma de Pago</th><th>No. Certificado</th><th>Tipo Comprobante</th>";
echo "</thead>";
echo "<tbody>";
foreach ($xml->xpath('//cfdi:Comprobante') as $cfdiComprobante) {
    echo "<tr>";
    echo "<td>" . $cfdiComprobante['version'] . "</td>";
    echo "<td>" . $cfdiComprobante['fecha'] . "</td>";
//                        echo "<td>" .  $cfdiComprobante['sello'] . "</td>";
    echo "<td>" . $cfdiComprobante['total'] . "</td>";
    echo "<td>" . $cfdiComprobante['subTotal'] . "</td>";
//                        echo "<td>" . $cfdiComprobante['certificado'] . "</td>";
    echo "<td>" . $cfdiComprobante['formaDePago'] . "</td>";
    echo "<td>" . $cfdiComprobante['noCertificado'] . "</td>";
    echo "<td>" . $cfdiComprobante['tipoDeComprobante'] . "</td>";
    echo "</tr>";
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
    echo "<td>" . $Emisor['rfc'] . "</td>";
    echo "<td>" . $Emisor['nombre'] . "</td>";
    echo "</tr>";
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

echo "<span class='label label-default'>Expedido en </span>";
echo "<blockquote>";
echo "<table class='table table-hover'>";
echo "<thead>";
echo "<th>Pais</th><th>Calle</th><th>Estado</th><th>Colonia</th><th>No. Exterior</th><th>Codigo Postal</th>";
echo "</thead>";
echo "<tbody>";
foreach ($xml->xpath('//cfdi:Comprobante//cfdi:Emisor//cfdi:ExpedidoEn') as $ExpedidoEn) {
    echo "<tr>";
    echo "<td>" . $ExpedidoEn['pais'] . "</td>";
    echo "<td>" . $ExpedidoEn['calle'] . "</td>";
    echo "<td>" . $ExpedidoEn['estado'] . "</td>";
    echo "<td>" . $ExpedidoEn['colonia'] . "</td>";
    echo "<td>" . $ExpedidoEn['noExterior'] . "</td>";
    echo "<td>" . $ExpedidoEn['codigoPostal'] . "</td>";
    echo "</tr>";
}
echo "</tbody>";
echo "</table>";
echo "</blockquote>";

echo "<span class='label label-default'>Receptor </span>";
echo "<blockquote>";
echo "<table class='table table-hover'>";
echo "<thead>";
echo "<th>RFC</th><th>Nombre</th>";
echo "</thead>";
echo "<tbody>";
foreach ($xml->xpath('//cfdi:Comprobante//cfdi:Receptor') as $Receptor) {
    echo "<tr>";
    echo "<td>" . $Receptor['rfc'] . "</td>";
    echo "<td>" . $Receptor['nombre'] . "</td>";
    echo "</tr>";
    $encabezadoEntrada->setRfc(utf8_decode($Receptor['rfc']));
    $encabezadoEntrada->setNombre(UTF8_decode($Receptor['nombre']));
}
echo "</tbody>";
echo "</table>";
echo "</blockquote>";

echo "<span class='label label-default'>Domicilio del receptor </span>";
echo "<blockquote>";
echo "<table class='table table-hover'>";
echo "<thead>";
echo "<th>Pais</th><th>Calle</th><th>Estado</th><th>Colonia</th><th>Municipio</th><th>No Exterior</th><th>No Interior</th><th>Codiogo Postal</th>";
echo "</thead>";
echo "<tbody>";
foreach ($xml->xpath('//cfdi:Comprobante//cfdi:Receptor//cfdi:Domicilio') as $ReceptorDomicilio) {
    echo "<tr>";
    echo "<td>" . $ReceptorDomicilio['pais'] . "</td>";
    echo "<td>" . $ReceptorDomicilio['calle'] . "</td>";
    echo "<td>" . $ReceptorDomicilio['estado'] . "</td>";
    echo "<td>" . $ReceptorDomicilio['colonia'] . "</td>";
    echo "<td>" . $ReceptorDomicilio['municipio'] . "</td>";
    echo "<td>" . $ReceptorDomicilio['noExterior'] . "</td>";
    echo "<td>" . $ReceptorDomicilio['noInterior'] . "</td>";
    echo "<td>" . $ReceptorDomicilio['codigoPostal'] . "</td>";
    echo "</tr>";
    $encabezadoEntrada->setCalle(utf8_decode($ReceptorDomicilio['calle']));
    $encabezadoEntrada->setEstado(utf8_decode($ReceptorDomicilio['estado']));
    $encabezadoEntrada->setColonia(utf8_decode($ReceptorDomicilio['colonia']));
    $encabezadoEntrada->setCiudad(utf8_decode($ReceptorDomicilio['municipio']));
    $encabezadoEntrada->setNo(utf8_decode($ReceptorDomicilio['noExterior']));
    $encabezadoEntrada->setCp(utf8_decode($ReceptorDomicilio['codigoPostal']));
}
echo "</tbody>";
echo "</table>";
echo "</blockquote>";
echo "<span class='label label-default'>Concepto </span>";
echo "<blockquote>";
echo "<table id='tblconceptos' class='table table-hover'>";
echo "<thead>";
echo "<th>Unidad</th><th>Importe</th><th>Cantidad</th><th>Id</th><th>Descripcion</th><th>Valor Unitario</th><th>Descuento</th><th>Valor Total</th>";
echo "</thead>";
echo "<tbody>";
//                    $id = $dao->guardaEncabezado($encabezado);
$arrayDetalleEntrada = [];
$cont = 0;
$cuentaid = 0;
foreach ($xml->xpath('//cfdi:Comprobante//cfdi:Conceptos//cfdi:Concepto') as $Concepto) {
    echo "<tr>";
    echo "<td>" . $Concepto['unidad'] . "</td>";
    echo "<td>" . $Concepto['importe'] . "</td>";
    echo "<td>" . $Concepto['cantidad'] . "</td>";
    echo "<td><input type='text' class='form-control' id='id$cuentaid' onblur='dameValorId($cuentaid);' value='" . $Concepto['noIdentificacion'] . "' /></td>";
    echo "<td>" . $Concepto['descripcion'] . "</td>";
    echo "<td>" . $Concepto['valorUnitario'] . "</td>";
    echo "<td><input type='text' maxlength='3' class='form-control' id='dct$cuentaid' onkeyup='dameValorDescuento($cuentaid);'/></td>";
    echo "<td><input type='text' class='form-control' id='total$cuentaid' disabled='false' value='" . $Concepto['valorUnitario'] . "' /></td>";
    echo "</tr>";
    $detalle->setUnidadmedida(utf8_decode($Concepto['unidad']));
    $detalle->setSubtotal(utf8_decode($Concepto['importe']));
    $detalle->setCantidad(utf8_decode($Concepto['cantidad']));
    $detalle->setId(utf8_decode($Concepto['noIdentificacion']));
    $detalle->setNombre(utf8_decode($Concepto['descripcion']));
    $detalle->setPreciounitario(utf8_decode($Concepto['valorUnitario']));
    $arrayDetalleEntrada[$cont] = $detalle;
    $detalle = new Detalle();
    $cont++;
    $cuentaid++;
}
echo "<input id='control' type='hidden' value='" . $cont . "' />";
echo "</tbody>";
echo "</table>";
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

echo "<span class='label label-default'>Timbre Fiscal </span>";
echo "<blockquote>";
echo "<table class='table table-hover'>";
echo "<thead>";
echo "<th>Fecha de Timbrado</th><th>UUID</th><th>No. Certificado SAT</th><th>Version</th>";
echo "</thead>";
echo "<tbody>";
foreach ($xml->xpath('//t:TimbreFiscalDigital') as $tfd) {
    echo "<tr>";
//                        echo "<td>" . $tfd['selloCFD']. "</td>";
    echo "<td>" . $tfd['FechaTimbrado'] . "</td>";
    echo "<td>" . $tfd['UUID'] . "</td>";
    echo "<td>" . $tfd['noCertificadoSAT'] . "</td>";
    echo "<td>" . $tfd['version'] . "</td>";
//                        echo "<td>" . $tfd['selloSAT']. "</td>";
    echo "</tr>";
}
echo "</tbody>";
echo "</table>";
echo "</blockquote>";
$_SESSION['objEncabezadoEntrada'] = $encabezadoEntrada;
$_SESSION['arrayDetalleEntrada'] = $arrayDetalleEntrada;
unlink($archivo);
?>
