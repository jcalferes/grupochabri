<?php

include_once './administracion.dao/dao.php';
$dao = new dao();
$aceptarTransferecnia = $_GET["aceptarTransferencia"];

$dao->cambiarEstatusTransferencia($aceptarTransferecnia);
