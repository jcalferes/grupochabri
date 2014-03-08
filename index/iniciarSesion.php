<?php

include './indes.clases/Usuario.php';
include './index.dao/dao.php';
include '../utileriasPhp/Utilerias.php';

$dao = new dao();
$usuario = new Usuario();
$utilerias = new Utilerias();

$usuario->setPass($utilerias->genera_md5($_GET["pass"]));
$usuario->setNombre($_GET["nombre"]);

$dao->iniciarSesion($usuario);
