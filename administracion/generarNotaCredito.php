<?php

session_start();
include_once '../dompdf/dompdf_config.inc.php';
include_once './administracion.dao/dao.php';

# Instanciamos un objeto de la clase DOMPDF. 

$idsucursal = 1;
$mipdf = new DOMPDF();
error_reporting(0);

$dao = new dao();



//========================= Inicia diseÃ±o ======================================
$valor = '
<html>
    <head>
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
.CSSTableGenerator {
	margin:0px;
        padding:0px;
	width:100%;
	box-shadow: 10px 10px 5px #888888;
	border:1px solid #000000; <!-- Bordes exteriores -->
	
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
}
.CSSTableGenerator table{
        border-collapse: collapse;
        border-spacing: 0px;
	width:100%;
	height:100%;
	margin:0px;
        padding:0px;
}
.CSSTableGenerator tr:last-child td:last-child {
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
}
.CSSTableGenerator tr:last-child td:first-child{
	-moz-border-radius-bottomleft:0px;
	-webkit-border-bottom-left-radius:0px;
	border-bottom-left-radius:0px;
}
.CSSTableGenerator tr:hover td{
	
}
.CSSTableGenerator tr:nth-child(odd){ 
    background-color:#e5e5e5; 
}
.CSSTableGenerator tr:nth-child(even) {
    background-color:#ffffff; 
}
.CSSTableGenerator td{
	text-align:left;
	padding:0px;
	font-size:12px;
	font-family:Times New Roman;
	font-weight:normal;
	color:#000000;
}
.CSSTableGenerator tr:last-child td{
	border-width:0px 1px 0px 0px;
}
.CSSTableGenerator tr td:last-child{
	border-width:0px 0px 1px 0px;
}
.CSSTableGenerator tr:last-child td:last-child{
	border-width:0px 0px 0px 0px;
}
.CSSTableGenerator tr:first-child td{
        background:-o-linear-gradient(bottom, #cccccc 5%, #b2b2b2 100%);	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #cccccc), color-stop(1, #b2b2b2) );
	background:-moz-linear-gradient( center top, #cccccc 5%, #b2b2b2 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr="#cccccc", endColorstr="#b2b2b2");	background: -o-linear-gradient(top,#cccccc,b2b2b2);
	background-color:#cccccc;
	border:0px solid #000000;
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
    </head>
    <body LANG="es-MX" DIR="LTR">';
$valor .= '<script type="text/php">


if ( isset($pdf) ) {


$font = Font_Metrics::get_font("helvetica", "bold"); $pdf->page_text(500, 800, "Pag: {PAGE_NUM} de {PAGE_COUNT}", $font, 6, array(0,0,0));


} </script>';
$valor .= ' <center>
   <img src="administracion.imgs/cabecera_' . $idsucursal . '.png" width="785px"/> 
    </center>';
$valor .= '      <table class="CSSTableGenerator">';
//while ($datoscliente = mysql_fetch_array($datos)) {
$valor .= ' <tr><td>Nombre:<br> NULL </td><td>RFC:<br> NULL </td><td>Nota de Credtio:<br><label style="color: red; font-size: larger">NULL</label><br>Fecha de emision:<br>NULL</td></tr>
        <tr><td>Direccion:<br> "Calle NULL num ext NULL num int NULL cruzamientos NULL </td><td>Colonia:<br> NULL</td><td></td></tr>
        <tr style="background-color: white"><td>Localidad/Municipio:<br>NULL</td><td>Estado:<br> NULL</td><td>CP:<br>NULL</td></tr>';
//    break;
//}
$valor .= '</table>';

$valor .= '  <table class="CSSTableGenerator">
                    <tr><td>Cant.</td>
                    <td>Codigo</td>
                    <td>Descrip.</td>
                    <td>Medidas(M3)</td>
                   <!-- <td>Costo Ant.</td>-->
                    <td>Costo</td>
                 <!--   <td>Desct. 1</td>-->
                 <!--   <td>Desct. 2</td>-->
                   <!-- <td>Desct. Total</td>-->
                    <td>CDA</td>
                    <td>Importe</td></tr> ';


//        $valor .= '<tr><td style="text-align: right">' . $datoscliente["cantidadConcepto"] . '</td><td style="text-align: right">' . $datoscliente["codigoConcepto"] . '</td><td >' . $datoscliente["descripcionConcepto"] . '</td><td>' . $datoscliente["metrosCubicos"] . '</td><!--<td style="text-align: right">$' . number_format($datoscliente["precioUnitarioConcepto"], 2) . '</td>--><td style="text-align: right">$' . number_format($datoscliente["costoCotizacion"], 2) . '</td><!--<td style="text-align: right">$' . number_format($datoscliente["desctUnoConcepto"], 2) . '</td><td style="text-align: right">$' . number_format($datoscliente["desctDosConcepto"], 2) . '</td><td style="text-align: right">$' . $datoscliente["totalComprobante"] . '</td>--><td style="text-align: right">$' . number_format($datoscliente["cdaConcepto"], 2) . '</td><td style="text-align: right">$' . number_format($datoscliente["importeConcepto"], 2) . '</td></tr>';
$valor .= '</table>';
$valor .= '<div style="position:relative"><br><table class="CSSTableGenerator" style="position:absolute; left:490px; width:30%; "><tr><td>Subtotal:</td><td style="text-align: right">$NULL</td></tr><tr><td>  Desc. General :</td><td style="text-align: right"> $NULL</td></tr><tr><td> Desc. Productos: </td><td style="text-align: right">$NULL</td></tr><tr><td>  Desc. Total : </td><td style="text-align: right">$NULL</td></tr><tr><td> SDA :</td><td style="text-align: right">$NULL</td></tr><tr><td>  Iva 16% :</td><td style="text-align: right"> $NULL</td></tr><tr><td>  Total :</td><td style="text-align: right"> $NULL</td></tr> </table>'
        . '<div style="position:absolute; top:150px; left:370; "><label style="font-size: x-small">Total de m<sup>3</sup>: NULL </label></div>';
$valor .= '<br><table class="CSSTableGenerator" style="position:absolute; top:19px; width:65%; "><tr><td>Cantidad con letra:<br>Total: NULL </td></tr><tr><td>Moneda y tipo de cambio:<br>MXN 1.00</td></tr></table>';
$valor .= '<br><table class="CSSTableGenerator" style="position:absolute; top:170px;"><tr><td>Informacion del transporte empleado:</td></tr>'
        . '<tr><td>Medio de transporte:</td><td>En el caso de camiones:</td></tr>'
        . '<tr><td>Marca:</td><td>Modelo:</td><td>Tipo:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>'
        . '<tr><td>Capacidad:</td><td>Placas o matricula:</td></tr>'
        . '</table></div>';
$valor .= '<br></body></html>';
//Termina Diseño================================================================
# Definimos el tamaÃ±o y orientaciÃ³n del papel que queremos.
# O por defecto cogerÃ¡ el que estÃ¡ en el fichero de configuraciÃ³n.
$mipdf->set_paper("A4", "portrait");
//$font = Font_Metrics::get_font("verdana", "bold");
//$mipdf->page_text(72, 18, "Header: {PAGE_NUM} of {PAGE_COUNT}", $font, 6, array(0, 0, 0));
# Cargamos el contenido HTML.
$mipdf->load_html(utf8_decode($valor));

# Renderizamos el documento PDF.
$mipdf->render();
//$mipdf->output();
file_put_contents("reportes/NotaCredito.pdf", $mipdf->output());
# Enviamos el fichero PDF al navegador.
//$mipdf->stream('reportes/NotaCredito.pdf', array("Attachment" => 0));
//$mipdf->stream('reportes/NotaCredito.pdf');
$mipdf->stream('reportes/NotaCredito.pdf', array("Attachment" => 0));
unlink("reportes/NotaCredito.pdf");
