<?php

include './administracion.dao/dao.php';


$dao = new dao();
$lista = json_decode(stripslashes($_GET["listaPrecio"]));
$dao->eliminaListaPrecio($lista);