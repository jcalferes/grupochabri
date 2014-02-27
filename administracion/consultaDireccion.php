<?php

include_once './administracion.dao/dao.php';
$dao = new dao();
$id = $_GET["id"];
$datos = $dao->obtieneDireccionDeProveedor($id);
while ($rs = mysql_fetch_array($datos)) {
    echo "<label>Calle:</label> $rs[calle]<br>";
    echo "<label>No. Exterior:</label> $rs[numeroExterior]<br>";
    echo "<label>No. Interior:</label> $rs[numeroInterior]<br>";
    echo "<label>Cruzamientos:</label> $rs[cruzamientos]<br>";
    echo "<label>CP:</label> $rs[cp]<br>";
    echo "<label>Asentamiento:</label> " . utf8_encode($rs["asenta"]) . "<br>";
    echo "<label>Municipio:</label> " . utf8_encode($rs["municipio"]) . "<br>";
    echo "<label>Estado:</label> " . utf8_encode($rs["estado"]) . "<br>";
    echo "<label>Ciudad:</label> " . utf8_encode($rs["ciudad"]);
}


