<?php

include './administracion.dao/dao.php';
include './administracion.clases/Maquina.php';
$maquina = new Maquina();
$dao = new dao();
$maquina->setNombreMaquina($_GET["nombre"]);
$dao->guardarMaquina($maquina);
