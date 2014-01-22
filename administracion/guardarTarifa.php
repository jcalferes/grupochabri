<?php
session_start();
include './administracion.clases/Tarifa.php';
include './administracion.dao/dao.php';
$tarifa = new Tarifa();
$dao = new dao();
$id=$_SESSION["idProducto"];
$tarifa->setTarifa($_GET["Tarifa"]);
$tarifa->setIdListaPrecio($_GET["listaPrecio"]);
$tarifa->setIdProducto($id);

$dao->guardarTarifa($tarifa);

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

