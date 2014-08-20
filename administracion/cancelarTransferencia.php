<?php

include_once './administracion.dao/dao.php';
$dao = new dao();
$aceptarTransferecnia = $_POST["transf"];

$dao->cambiarEstatusCancelarTransferencia($aceptarTransferecnia);
