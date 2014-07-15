<?php

include './administracion.dao/dao.php';
$dao = new dao();
$rs = $dao->prueba();

echo $rs;
