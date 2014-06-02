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
$datos = $dao->obtenerOrdenCompra(trim($folio), $comprobante);
$validar = mysql_affected_rows();
if ($validar > 0) {
//========================= Inicia diseño ======================================
    $valor = '
        <html>
        <head></head>
        <body><body>
        </html>


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
        .CSSTableGenerator {
	margin:0px;padding:0px;
	width:100%;
	box-shadow: 10px 10px 5px #888888;
	border:1px solid #000000;
	
	-moz-border-radius-bottomleft:0px;
	-webkit-border-bottom-left-radius:0px;
	border-bottom-left-radius:0px;
	
	-moz-border-radius-bottomright:0px;
	-webkit-border-bottom-right-radius:0px;
	border-bottom-right-radius:0px;
	
	-moz-border-radius-topright:0px;
	-webkit-border-top-right-radius:0px;
	border-top-right-radius:0px;
	
	-moz-border-radius-topleft:0px;
	-webkit-border-top-left-radius:0px;
	border-top-left-radius:0px;
}.CSSTableGenerator table{
    border-collapse: collapse;
        border-spacing: 0;
	width:100%;
	height:100%;
	margin:0px;padding:0px;
}.CSSTableGenerator tr:last-child td:last-child {
	-moz-border-radius-bottomright:0px;
	-webkit-border-bottom-right-radius:0px;
	border-bottom-right-radius:0px;
}
.CSSTableGenerator table tr:first-child td:first-child {
	-moz-border-radius-topleft:0px;
	-webkit-border-top-left-radius:0px;
	border-top-left-radius:0px;
}
.CSSTableGenerator table tr:first-child td:last-child {
	-moz-border-radius-topright:0px;
	-webkit-border-top-right-radius:0px;
	border-top-right-radius:0px;
}.CSSTableGenerator tr:last-child td:first-child{
	-moz-border-radius-bottomleft:0px;
	-webkit-border-bottom-left-radius:0px;
	border-bottom-left-radius:0px;
}.CSSTableGenerator tr:hover td{
	
}
.CSSTableGenerator tr:nth-child(odd){ background-color:#e5e5e5; }
.CSSTableGenerator tr:nth-child(even)    { background-color:#ffffff; }.CSSTableGenerator td{
	vertical-align:middle;
	border:1px solid #000000;
	border-width:0px 1px 1px 0px;
	text-align:left;
	padding:7px;
	font-size:10px;
	font-family:Times New Roman;
	font-weight:normal;
	color:#000000;
}.CSSTableGenerator tr:last-child td{
	border-width:0px 1px 0px 0px;
}.CSSTableGenerator tr td:last-child{
	border-width:0px 0px 1px 0px;
}.CSSTableGenerator tr:last-child td:last-child{
	border-width:0px 0px 0px 0px;
}
.CSSTableGenerator tr:first-child td{
		background:-o-linear-gradient(bottom, #cccccc 5%, #b2b2b2 100%);	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #cccccc), color-stop(1, #b2b2b2) );
	background:-moz-linear-gradient( center top, #cccccc 5%, #b2b2b2 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr="#cccccc", endColorstr="#b2b2b2");	background: -o-linear-gradient(top,#cccccc,b2b2b2);

	background-color:#cccccc;
	border:0px solid #000000;
	text-align:center;
	border-width:0px 0px 1px 1px;
	font-size:14px;
	font-family:Times New Roman;
	font-weight:bold;
	color:#000000;
}
.CSSTableGenerator tr:first-child:hover td{
	background:-o-linear-gradient(bottom, #cccccc 5%, #b2b2b2 100%);	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #cccccc), color-stop(1, #b2b2b2) );
	background:-moz-linear-gradient( center top, #cccccc 5%, #b2b2b2 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr="#cccccc", endColorstr="#b2b2b2");	background: -o-linear-gradient(top,#cccccc,b2b2b2);

	background-color:#cccccc;
}
.CSSTableGenerator tr:first-child td:first-child{
	border-width:0px 0px 1px 0px;
}
.CSSTableGenerator tr:first-child td:last-child{
	border-width:0px 0px 1px 1px;
}
	</STYLE>
</HEAD>
<BODY LANG="es-MX" DIR="LTR">
 <IMG SRC="administracion.imgs/titulos.png" NAME="Imagen 1" ALIGN="center" HSPACE=12 WIDTH=650 HEIGHT=182 BORDER=0>
 <h4>FOLIO NO.-' . $folio . ' </h4>
<table class="CSSTableGenerator">
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
        $valor .= '<tr><td style="text-align: right">$' . number_format($datosOrden["cantidadConcepto"], 2) . '</td><td style="text-align: right">$' . number_format($datosOrden["codigoConcepto"], 2) . '</td><td >' . $datosOrden["descripcionConcepto"] . '</td><td style="text-align: right">$' . number_format($datosOrden["precioUnitarioConcepto"], 2) . '</td><td style="text-align: right">$' . number_format($datosOrden["costoCotizacion"], 2) . '</td><td style="text-align: right">$' . number_format($datosOrden["desctUnoConcepto"], 2) . '</td><td style="text-align: right">$' . number_format($datosOrden["desctDosConcepto"], 2) . '</td><td style="text-align: right">$' . $datosOrden["totalComprobante"] . '</td><td style="text-align: right">$' . number_format($datosOrden["cdaConcepto"], 2) . '</td><td style="text-align: right">$' . number_format($datosOrden["importeConcepto"], 2) . '</td></tr>';
//        $arr[][] = array('subtotalComprobante' => $datosOrden["subtotalComprobante"], 'sdaComprobante' => $datosOrden["sdaComprobante"], 'rfcComprobante' => $datosOrden["rfcComprobante"], 'desctFacturaComprobante' => $datosOrden["desctFacturaComprobante"], 'desctProntoPagoComprobante' => $datosOrden["desctProntoPagoComprobante"], 'desctTotalComprobante' => $datosOrden["desctTotalComprobante"], 'desctGeneralComprobante' => $datosOrden["desctGeneralComprobante"], 'ivaComprobante' => $datosOrden["ivaComprobante"], 'totalComprobante' => $datosOrden["totalComprobante"], 'folioComprobante' => $datosOrden["folioComprobante"], 'tipoComprobante' => $datosOrden["tipoComprobante"], 'cantidadConcepto' => $datosOrden["cantidadConcepto"], 'descripcionConcepto' => $datosOrden["descripcionConcepto"], 'precioUnitarioConcepto' => $datosOrden["precioUnitarioConcepto"], 'cdaConcepto' => $datosOrden["cdaConcepto"], 'desctUnoConcepto' => $datosOrden["desctUnoConcepto"], 'desctDosConcepto' => $datosOrden["desctDosConcepto"], 'importeConcepto' => $datosOrden["importeConcepto"],'costoCotizacion' => $datosOrden["costoCotizacion"]);
    }
    $valor .= '
                </table>';

    $valor .= '<table  border = "1" class="CSSTableGenerator" ><tr><td>Subtotal:</td><td style="text-align: right">$' . number_format($subtotal, 2) . '</td></tr><tr><td>  Desc. General :</td><td style="text-align: right"> $' . number_format($descGral, 2) . '</td></tr><tr><td> Desc. Productos: </td><td style="text-align: right">$' . number_format($descProd, 2) . '</td></tr><tr><td>  Desc. Total : </td><td style="text-align: right">$' . number_format($descTotal, 2) . '</td></tr><tr><td> SDA :</td><td style="text-align: right">$' . number_format($sda, 2) . '</td></tr><tr><td>  Iva 16% :</td><td style="text-align: right"> $' . number_format($iva, 2) . '</td></tr><tr><td>  Total :</td><td style="text-align: right"> $' . number_format($total, 2) . '</td></tr> </table>
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
//Termina Diseño================================================================
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
