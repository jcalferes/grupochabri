<?php

$xml = new SimpleXMLElement("chabri.xml", null, true);
$namespaces = $xml->getDocNamespaces();

if (array_key_exists('cfdi', $namespaces)) {
//    $xml->xpath('//cfdi:');



    foreach ($xml->xpath('//cfdi:Comprobante//cfdi:Concepto') as $Emisor) {
        echo "yo leo con cfdi<br />";
        echo $Emisor['cantidad'];
        echo "<br />";
        echo utf8_decode($Emisor['unidad']);
        echo "<br />";
        echo "saliendo de leo con cfdi<br />";
    }
} else {
    foreach ($xml->Emisor as $Emisor) {
        echo "yo leo sin cfdi<br />";
        echo $Emisor['rfc'];
        echo "<br />";
        echo $Emisor['nombre'];
        echo "<br />";
        echo "saliendo de leo sin cfdi<br />";
    }
}
?>