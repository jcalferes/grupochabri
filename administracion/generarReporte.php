<?php

echo 'dsadsadsa';
include_once '../dompdf/dompdf_config.inc.php';
include_once './administracion.dao/dao.php';
# Instanciamos un objeto de la clase DOMPDF.
$folio = $_GET["valor"];
$dao = new dao();
$datos = $dao->obtenerOrdenCompra($folio);
$validar = mysql_affected_rows();
if ($validar > 0) {

    $valor = '
<html>

<body>
 
<table border ="1">
                   
                    <tr><td>Cantidad</td>
                    <td>Codigo</td>
                    <td>Descripcion</td>
                    <td>Costo Anterior</td>
                    <td>Costo</td>
                    <td>Desct. 1</td>
                    <td>Desct. 2</td>
                    <td>Desct. Total</td>
                    <td>CDA</td>
                    <td>Importe</td></tr> ';

    while ($datosOrden = mysql_fetch_array($datos)) {
$subtotal = $datosOrden["subtotalComprobante"];
$descGral = $datosOrden["desctGeneralComprobante"];
$descProd = $datosOrden["desctPorProductosComprobante"];
$descTotal = $datosOrden["desctTotalComprobante"];
$sda = $datosOrden["sdaComprobante"];
$iva = $datosOrden["ivaComprobante"];
$total = $datosOrden["totalComprobante"];
        $valor .= '<tr><td>' . $datosOrden["cantidadConcepto"] . '</td><td>' . $datosOrden["codigoConcepto"] . '</td><td>' . $datosOrden["descripcionConcepto"] . '</td><td>' . $datosOrden["precioUnitarioConcepto"] . '</td><td>' . $datosOrden["costoCotizacion"] . '</td><td>' . $datosOrden["desctUnoConcepto"] . '</td><td>' . $datosOrden["desctDosConcepto"] . '</td><td>' . $datosOrden["totalComprobante"] . '</td><td>' . $datosOrden["cdaConcepto"] . '</td><td>' . $datosOrden["importeConcepto"] . '</td></tr>';
//        $arr[][] = array('subtotalComprobante' => $datosOrden["subtotalComprobante"], 'sdaComprobante' => $datosOrden["sdaComprobante"], 'rfcComprobante' => $datosOrden["rfcComprobante"], 'desctFacturaComprobante' => $datosOrden["desctFacturaComprobante"], 'desctProntoPagoComprobante' => $datosOrden["desctProntoPagoComprobante"], 'desctTotalComprobante' => $datosOrden["desctTotalComprobante"], 'desctGeneralComprobante' => $datosOrden["desctGeneralComprobante"], 'ivaComprobante' => $datosOrden["ivaComprobante"], 'totalComprobante' => $datosOrden["totalComprobante"], 'folioComprobante' => $datosOrden["folioComprobante"], 'tipoComprobante' => $datosOrden["tipoComprobante"], 'cantidadConcepto' => $datosOrden["cantidadConcepto"], 'descripcionConcepto' => $datosOrden["descripcionConcepto"], 'precioUnitarioConcepto' => $datosOrden["precioUnitarioConcepto"], 'cdaConcepto' => $datosOrden["cdaConcepto"], 'desctUnoConcepto' => $datosOrden["desctUnoConcepto"], 'desctDosConcepto' => $datosOrden["desctDosConcepto"], 'importeConcepto' => $datosOrden["importeConcepto"],'costoCotizacion' => $datosOrden["costoCotizacion"]);
    }
    $valor .= '
                </table>';
    
    $valor .= 'Subtotal :' .$subtotal. '  Desc. General : '.$descGral.' Desc. Productos: '.$descProd.'  Desc. Total : '.$descTotal.' SDA :'.$sda.'  Iva 16% : '.$iva.'  Total : '.$total.' </body>
</html>';
} else {
    echo '0';
}

//
//$resp = $valor . $valor2 . $valor3;
$mipdf = new DOMPDF();


$interfaz = '
 <html>
 <body>
 <table>
                     <tr>
                     <td>1</td>
                     <td>2121</td>
                     <td>dsadsa</td>
                     <td>19.0000</td>
                     <td>12</td>
                     <td>1.0000</td>
                     <td>2.0000</td>
                     <td>2.8800</td>
                     <td>11.6400</td>
                     <td>11.6400</td>
                     </tr>
 </table>
 </body>
 </html>';




# Definimos el tamaño y orientación del papel que queremos.
# O por defecto cogerá el que está en el fichero de configuración.
$mipdf->set_paper("A4", "portrait");

# Cargamos el contenido HTML.
$mipdf->load_html(utf8_decode($valor));

# Renderizamos el documento PDF.
$mipdf->render();
$output = $mipdf->output();
file_put_contents("../reportes/probando.pdf", $output);
# Enviamos el fichero PDF al navegador.
//$mipdf->stream('FicheroEjemplo.pdf');
