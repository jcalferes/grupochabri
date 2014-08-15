<?php

session_start();
$nsuc = $_GET["nsuc"];
$_SESSION["sucursalSesion"] = $nsuc;
echo true;

