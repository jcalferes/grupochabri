<?php

$nombre = $_FILES['buscaxml']['name'];
$ruta = $_FILES['buscaxml']['tmp_name'];
$tipo = $_FILES['buscaxml']['type'];
$tamano = $_FILES['buscaxml']['size'];
$maximo = 700 * 1024;
$ubicacion = "../subidas/" . $nombre;

$ext_permitidas = array('xml');
$partes_nombre = explode('.', $nombre);
$extension = end($partes_nombre);
$ext_correcta = in_array($extension, $ext_permitidas);


if ($ext_correcta && $tamano <= $maximo) {
    if (copy($ruta, $ubicacion)) {
        $xml = new SimpleXMLElement($ubicacion, null, true);
        $namespaces = $xml->getDocNamespaces();

        if (array_key_exists('cfdi', $namespaces)) {
            foreach ($xml->xpath('//cfdi:Comprobante//cfdi:Concepto') as $Emisor) {
                echo "yo leo con cfdi<br />";
                echo $Emisor['cantidad'];
                echo "<br />";
                echo utf8_decode($Emisor['unidad']);
                echo "<br />";
                echo "saliendo de leo con cfdi<br />";
            }
        }

        unlink($ubicacion);
    } else {
        echo '<script> alertify.error("Archivo invalido o muy grande.");</script>';
    }
}
?>