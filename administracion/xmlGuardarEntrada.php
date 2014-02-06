<?php

session_start();
$datos = json_decode($_POST['datos']);
$control = count($datos);

