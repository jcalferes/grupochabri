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
    echo "<label>CP:</label> $rs[postal]<br>";
    echo "<label>Colonia:</label> " . $rs["colonia"] . "<br>";
    echo "<label>Estado:</label> " . $rs["estado"] . "<br>";
    echo "<label>Ciudad:</label> " . $rs["ciudad"];
}


