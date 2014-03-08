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
$encabezadoSalida = new Encabezado();
$detallex = new Detalle();


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
//                        echo "<td>" .  $cfdiComprobante['sello'] . "</td>";
    echo "<td>" . $cfdiComprobante['total'] . "</td>";
    echo "<td>" . $cfdiComprobante['subTotal'] . "</td>";
//                        echo "<td>" . $cfdiComprobante['certificado'] . "</td>";
    echo "<td>" . $cfdiComprobante['formaDePago'] . "</td>";
    echo "<td>" . $cfdiComprobante['noCertificado'] . "</td>";
    echo "<td>" . $cfdiComprobante['tipoDeComprobante'] . "</td>";
    echo "</tr>";
    $encabezadoSalida->setFolio(utf8_decode($cfdiComprobante['folio']));
    $encabezadoSalida->setFecha(utf8_decode($cfdiComprobante['fecha']));
    $encabezadoSalida->setTotal(utf8_decode($cfdiComprobante['total']));
    $encabezadoSalida->setSubtotal(utf8_decode($cfdiComprobante['subTotal']));
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
}
$encabezadoSalida->setRfc(utf8_decode($Emisor['rfc']));
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
}
echo "</tbody>";
echo "</table>";
echo "</blockquote>";

echo "<span class='label label-default'>Concepto </span>";
echo "<blockquote>";
echo "<table class='table table-hover'>";
echo "<thead>";
echo "<th>Unidad</th><th>Importe</th><th>Cantidad</th><th>Id</th><th>Descripcion</th><th>Valor Unitario</th>";
echo "</thead>";
echo "<tbody>";

$arregloDetalleSalida = [];
$cont = 0;
foreach ($xml->xpath('//cfdi:Comprobante//cfdi:Conceptos//cfdi:Concepto') as $Concepto) {
    echo "<tr>";
    echo "<td>" . $Concepto['unidad'] . "</td>";
    echo "<td>" . $Concepto['importe'] . "</td>";
    echo "<td>" . $Concepto['cantidad'] . "</td>";
    echo "<td>" . $Concepto['noIdentificacion'] . "</td>";
    echo "<td>" . $Concepto['descripcion'] . "</td>";
    echo "<td>" . $Concepto['valorUnitario'] . "</td>";
    echo "</tr>";

    $detallex->setUnidadmedida(utf8_decode($Concepto['unidad']));
    $detallex->setImporte(utf8_decode($Concepto['importe']));
    $detallex->setCantidad(utf8_decode($Concepto['cantidad']));
    $detallex->setCodigo(utf8_decode($Concepto['noIdentificacion']));
    $detallex->setDescripcion(utf8_decode($Concepto['descripcion']));
    $detallex->setCosto(utf8_decode($Concepto['valorUnitario']));




    $arregloDetalleSalida[$cont] = $detallex;
    $detallex = new Detalle();
    $cont++;
}
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
$_SESSION['objEncabezadoSalida'] = $encabezadoSalida;
$_SESSION['arrayDetalleSalida'] = $arregloDetalleSalida;
unlink($archivo);
?>
