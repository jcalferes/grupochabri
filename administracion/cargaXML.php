<?php
include './administracion.clases/Detalle.php';
include './administracion.clases/Encabezado.php';
include './administracion.dao/dao.php';

$nombre = $_FILES['buscaxml']['name'];
$ruta = $_FILES['buscaxml']['tmp_name'];
$tipo = $_FILES['buscaxml']['type'];
$tamano = $_FILES['buscaxml']['size'];
$ubicacion = "../subidas/" . $nombre;

$ext_permitidas = array('xml', 'XML');
$partes_nombre = explode('.', $nombre);
$extension = end($partes_nombre);
$ext_correcta = in_array($extension, $ext_permitidas);


if ($ext_correcta) {
    if (copy($ruta, $ubicacion)) {
        $xml = simplexml_load_file($ubicacion);
        $ns = $xml->getNamespaces(true);
        $xml->registerXPathNamespace('c', $ns['cfdi']);
        $xml->registerXPathNamespace('t', $ns['tfd']);

        $encabezado = new Encabezado();
        $detalle = new Detalle();
        $dao = new dao();

//EMPIEZO A LEER LA INFORMACION DEL CFDI E IMPRIMIRLA 
//        foreach ($xml->xpath('//cfdi:Comprobante') as $cfdiComprobante) {
//            $encabezado->setFecha(utf8_decode($cfdiComprobante['fecha']));
//            $encabezado->setTotal(utf8_decode($cfdiComprobante['total']));
//            $encabezado->setSubtotal(utf8_decode($cfdiComprobante['subTotal']));
//        }
//
//        foreach ($xml->xpath('//cfdi:Comprobante//cfdi:Receptor') as $Receptor) {
//            $encabezado->setRfc(utf8_decode($Receptor['rfc']));
//            $encabezado->setNombre(UTF8_decode($Receptor['nombre']));
//        }
//        foreach ($xml->xpath('//cfdi:Comprobante//cfdi:Receptor//cfdi:Domicilio') as $ReceptorDomicilio) {
//            $encabezado->setCalle(utf8_decode($ReceptorDomicilio['calle']));
//            $encabezado->setEstado(utf8_decode($ReceptorDomicilio['estado']));
//            $encabezado->setColonia(utf8_decode($ReceptorDomicilio['colonia']));
//            $encabezado->setCiudad(utf8_decode($ReceptorDomicilio['municipio']));
//            $encabezado->setNo(utf8_decode($ReceptorDomicilio['noExterior']));
//            $encabezado->setCp(utf8_decode($ReceptorDomicilio['codigoPostal']));
//        }
//        $id = $dao->guardaEncabezado($encabezado);
//        $arrayDetalle = [];
//        $cont = 0;
//        foreach ($xml->xpath('//cfdi:Comprobante//cfdi:Conceptos//cfdi:Concepto') as $Concepto) {
//            $detalle->setUnidadmedida(utf8_decode($Concepto['unidad']));
//            $detalle->setSubtotal(utf8_decode($Concepto['importe']));
//            $detalle->setCantidad(utf8_decode($Concepto['cantidad']));
//            $detalle->setNombre(utf8_decode($Concepto['descripcion']));
//            $detalle->setPreciounitario(utf8_decode($Concepto['valorUnitario']));
//            $detalle->setIdFacturaEncabezado($id);
//            $arrayDetalle[$cont] = $detalle;
//            $cont++;
//        }
//        include_once '../daoconexion/daoConeccion.php';
//        $cn = new coneccion();
//        $cn->Conectarse();
//        foreach ($arrayDetalle as $detalle) {
//            $error = $dao->guardaDetalle($detalle);
//            echo $error;
//        }
//        $cn->cerrarBd();
//        unlink($ubicacion);
    }
}
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="shortcut icon" href="">
        <title>Gestion Administrativa - Grupo Chabri  </title>
        <!-- CSS -->
        <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="../bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">
        <link href="../alertify/themes/alertify.core.css" rel="stylesheet">
        <link href="../alertify/themes/alertify.default.css" rel="stylesheet">
        <!-- CSS Personalizados-->
    </head>
    <body>
        <div class="container">
            <!--                    Aqui todo el contenido de la pagina-->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Nueva Entrada XML</h3>
                </div>
                <div class="panel-body">
                    <?php
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
                        $encabezado->setFecha(utf8_decode($cfdiComprobante['fecha']));
                        $encabezado->setTotal(utf8_decode($cfdiComprobante['total']));
                        $encabezado->setSubtotal(utf8_decode($cfdiComprobante['subTotal']));
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
                        $encabezado->setRfc(utf8_decode($Receptor['rfc']));
                        $encabezado->setNombre(UTF8_decode($Receptor['nombre']));
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
                        $encabezado->setCalle(utf8_decode($ReceptorDomicilio['calle']));
                        $encabezado->setEstado(utf8_decode($ReceptorDomicilio['estado']));
                        $encabezado->setColonia(utf8_decode($ReceptorDomicilio['colonia']));
                        $encabezado->setCiudad(utf8_decode($ReceptorDomicilio['municipio']));
                        $encabezado->setNo(utf8_decode($ReceptorDomicilio['noExterior']));
                        $encabezado->setCp(utf8_decode($ReceptorDomicilio['codigoPostal']));
                    }
                    echo "</tbody>";
                    echo "</table>";
                    echo "</blockquote>";

                    echo "<span class='label label-default'>Concepto </span>";
                    echo "<blockquote>";
                    echo "<table class='table table-hover'>";
                    echo "<thead>";
                    echo "<th>Unidad</th><th>Importe</th><th>Cantidad</th><th>Descripcion</th><th>Valor Unitario</th>";
                    echo "</thead>";
                    echo "<tbody>";
                    $id = $dao->guardaEncabezado($encabezado);
                    $arrayDetalle = [];
                    $cont = 0;
                    foreach ($xml->xpath('//cfdi:Comprobante//cfdi:Conceptos//cfdi:Concepto') as $Concepto) {
                        echo "<tr>";
                        echo "<td>" . $Concepto['unidad'] . "</td>";
                        echo "<td>" . $Concepto['importe'] . "</td>";
                        echo "<td>" . $Concepto['cantidad'] . "</td>";
                        echo "<td>" . $Concepto['descripcion'] . "</td>";
                        echo "<td>" . $Concepto['valorUnitario'] . "</td>";
                        echo "</tr>";
                        $detalle->setUnidadmedida(utf8_decode($Concepto['unidad']));
                        $detalle->setSubtotal(utf8_decode($Concepto['importe']));
                        $detalle->setCantidad(utf8_decode($Concepto['cantidad']));
                        $detalle->setNombre(utf8_decode($Concepto['descripcion']));
                        $detalle->setPreciounitario(utf8_decode($Concepto['valorUnitario']));
                        $detalle->setIdFacturaEncabezado($id);
                        $arrayDetalle[$cont] = $detalle;
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
                    ?>
                </div>
                <div class="panel-footer text-center">
                    <!--Aqui los botones o similares-->

                    <!--========================================================-->
                </div>
            </div>
            <!--========================================================-->
        </div> <!-- /container -->
        <!-- JSCRIPT -->
        <script src="../bootstrap/js/jquery.js"></script>
        <script src="../bootstrap/js/bootstrap.min.js"></script>
        <script src="../alertify/lib/alertify.min.js"></script>
        <!--<script src="administracion.js/salidas.js"></script>-->
    </body>
</html>

