
<?php
include './administracion.clases/Detalle.php';
include './administracion.clases/Encabezado.php';
include './administracion.dao/dao.php';
//$ubicacion = $_GET["archivo"];
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
        foreach ($xml->xpath('//cfdi:Comprobante') as $cfdiComprobante) {
            $encabezado->setFecha(utf8_decode($cfdiComprobante['fecha']));
            $encabezado->setTotal(utf8_decode($cfdiComprobante['total']));
            $encabezado->setSubtotal(utf8_decode($cfdiComprobante['subTotal']));
        }

        foreach ($xml->xpath('//cfdi:Comprobante//cfdi:Receptor') as $Receptor) {
            $encabezado->setRfc(utf8_decode($Receptor['rfc']));
            $encabezado->setNombre(UTF8_decode($Receptor['nombre']));
        }
        foreach ($xml->xpath('//cfdi:Comprobante//cfdi:Receptor//cfdi:Domicilio') as $ReceptorDomicilio) {
            $encabezado->setCalle(utf8_decode($ReceptorDomicilio['calle']));
            $encabezado->setEstado(utf8_decode($ReceptorDomicilio['estado']));
            $encabezado->setColonia(utf8_decode($ReceptorDomicilio['colonia']));
            $encabezado->setCiudad(utf8_decode($ReceptorDomicilio['municipio']));
            $encabezado->setNo(utf8_decode($ReceptorDomicilio['noExterior']));
            $encabezado->setCp(utf8_decode($ReceptorDomicilio['codigoPostal']));
        }
        $id = $dao->guardaEncabezado($encabezado);
        $arrayDetalle = [];
        $cont = 0;
        foreach ($xml->xpath('//cfdi:Comprobante//cfdi:Conceptos//cfdi:Concepto') as $Concepto) {
            $detalle->setUnidadmedida(utf8_decode($Concepto['unidad']));
            $detalle->setSubtotal(utf8_decode($Concepto['importe']));
            $detalle->setCantidad(utf8_decode($Concepto['cantidad']));
            $detalle->setNombre(utf8_decode($Concepto['descripcion']));
            $detalle->setPreciounitario(utf8_decode($Concepto['valorUnitario']));
            $detalle->setIdFacturaEncabezado($id);
            $arrayDetalle[$cont] = $detalle;
            $cont++;
        }
        include_once '../daoconexion/daoConeccion.php';
        $cn = new coneccion();
        $cn->Conectarse();
        foreach ($arrayDetalle as $detalle) {
            $error = $dao->guardaDetalle($detalle);
            echo $error;
        }
        $cn->cerrarBd();
        unlink($ubicacion);
    }
}