<?php

include_once '../dompdf/dompdf_config.inc.php';
include_once './administracion.dao/dao.php';
include_once '../utilerias/Utilerias.php';
# Instanciamos un objeto de la clase DOMPDF. 
$mipdf = new DOMPDF();
error_reporting(0);
$escribio = "";
$correos = "";
$correos2 = "";
$folio = $_GET["valor"];
$correos = $_GET["correos"];
$correos2 = $_GET["correos2"];
$comprobante = $_GET["comprobante"];

$destinos[] = $correos;
if ($correos2 !== "") {
    $destinos[] = $correos2;
}
$dao = new dao();
$utileria = new Utilerias();
$datos = $dao->obtenerOrdenCompra($folio, $comprobante);
$validar = mysql_affected_rows();
if ($validar > 0) {

    $valor = '
<HTML>
<HEAD>
	<META HTTP-EQUIV="CONTENT-TYPE" CONTENT="text/html; charset=utf-8">
	<TITLE></TITLE>
	<META NAME="GENERATOR" CONTENT="LibreOffice 4.0.5.2 (Linux)">
	<META NAME="AUTHOR" CONTENT="Solis">
	<META NAME="CREATED" CONTENT="20140506;14450000">
	<META NAME="CHANGEDBY" CONTENT="Solis">
	<META NAME="CHANGED" CONTENT="20140506;15030000">
	<META NAME="AppVersion" CONTENT="14.0000">
	<META NAME="DocSecurity" CONTENT="0">
	<META NAME="HyperlinksChanged" CONTENT="false">
	<META NAME="LinksUpToDate" CONTENT="false">
	<META NAME="ScaleCrop" CONTENT="false">
	<META NAME="ShareDoc" CONTENT="false">
	<STYLE TYPE="text/css">
	<!--
		@page { size: 8.5in 11in; margin: 0.5in }
		P { margin-bottom: 0.08in; direction: ltr; widows: 2; orphans: 2 }
	-->
	</STYLE>
</HEAD>
<BODY LANG="es-MX" DIR="LTR">
                                                             
 <IMG SRC="administracion.imgs/titulos.png" NAME="Imagen 1" ALIGN=LEFT HSPACE=12 WIDTH=650 HEIGHT=182 BORDER=0>


 <h1>FOLIO NO.-' . $folio . ' </h1>
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

    $valor .= '<table border = 1><tr><td>Subtotal:</td><td>' . $subtotal . '</td></tr><tr><td>  Desc. General :</td><td> ' . $descGral . '</td></tr><tr><td> Desc. Productos: </td><td>' . $descProd . '</td></tr><tr><td>  Desc. Total : </td><td>' . $descTotal . '</td></tr><tr><td> SDA :</td><td>' . $sda . '</td></tr><tr><td>  Iva 16% :</td><td> ' . $iva . '</td></tr><tr><td>  Total :</td><td> ' . $total . '</td></tr> </table>
';

//$escribio = $utileria->numtoletras($total);
    $valor.='Total:' . $utileria->numtoletras($total) . '</body></html>';
} else {
    echo '0';
}

//
//$resp = $valor . $valor2 . $valor3;


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
//$mipdf->output();
file_put_contents("reportes/probando.pdf", $mipdf->output());
# Enviamos el fichero PDF al navegador.
//$mipdf->stream('reportes/probando.pdf', array("Attachment" => 0));
//$mipdf->stream('reportes/probando.pdf');
if ($comprobante !== "PEDIDO CLIENTE") {


    if ($correos !== "") {
//$correo = "shanaxchronos@gmail.com";
        $utileria->enviarCorreoElectronico($correo, $destinos);
        $mipdf->stream('reportes/probando.pdf', array("Attachment" => 0));
    }
} else {
    $mipdf->stream('reportes/probando.pdf', array("Attachment" => 0));
}