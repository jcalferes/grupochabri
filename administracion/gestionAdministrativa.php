<?php
include '../index/verificaSession.php';
$verificasession = new verificaSession();
$verificasession->validaSesion();
?>
<!DOCTYPE html>
<html lang="es"> 
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="shortcut icon" href="">
        <title>Gestion Administrativa - Grupo Chabri  </title>
        <!-- CSS -->
        <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="../bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">
        <link href="../bootstrap/css/simple-sidebar.css" rel="stylesheet">
        <link href="../alertify/themes/alertify.core.css" rel="stylesheet">
        <link href="../alertify/themes/alertify.default.css" rel="stylesheet">
        <link href="../jsteps/css/jquery.steps.css" rel="stylesheet">
        <link href="../dtbootstrap/dataTables.bootstrap.css" rel="stylesheet">
        <link href="../bootstrap/css/bootstrap-select.css" rel="stylesheet">
        <link href="../switchboostrap/css/bootstrap-switch.css" rel="stylesheet">
        <!-- CSS Personalizados-->
        <style>
            /* Move down content because we have a fixed navbar that is 50px tall */
            body {
                padding-top: 60px;
            }
        </style>
    </head>
    <header>
        <div class="navbar navbar-default navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar" ></span>
                    </button>
                    <a class="navbar-brand" href="#">Grupo Chabri</a>
                </div>
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li class=""><a href="#">Inicio</a></li>
                        <li><a href="#about">Acerca de</a></li>
                        <li><a href="#contact">Contacto</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Menu<b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Link</a></li>
                                <li><a href="#">Otro link</a></li>
                                <li><a href="#">Algun link</a></li>
                                <li class="divider"></li>
                                <li class="dropdown-header">Titulo de la seccion</li>
                                <li><a href="#">Un link</a></li>
                                <li><a href="#">Otro link</a></li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#">Un link</a></li>
                        <li><a href="#">Otro link</a></li>
                        <li class=""><a href="#">Un link mas</a></li>
                        <li><a href="../index/cerrarSesion.php">Cerrar Sesion</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </header>
    <body>
        <div id="wrapper">
            <div id="sidebar-wrapper">
                <ul class="sidebar-nav">
                    <li id="1" class=""><a onclick="entroMarca();">Marcas</a></li>
                    <li id="2" class=""><a onclick="entroProducto();">Productos</a></li>
                    <li id="3" class=""><a onclick="entroProveedor();">Proveedores</a></li>
                    <li id="9" class=""><a onclick="entroCliente();">Clientes</a></li>
                    <li id="4" class=""><a onclick="entroListaPrecio();">Listas</a></li>
                    <li id="10" class=""><a onclick="entroVentas();">Ventas</a></li>
                    <li id="5" class=""><a onclick="entroEntradasProductos();">Entradas</a></li>
                    <li id="7" class=""><a onclick="entroSalidasProduto();">Salidas</a></li>
                    <li id="11" class=""><a onclick="entroTrasferencia();">Transferencia</a></li>
                    <li id="8" class=""><a onclick="entroUsuarios();">Usuarios</a></li>
                </ul>
            </div>
            <div id="page-content-wrapper">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <a id="menu-toggle" class="btn btn-xs"><span class="glyphicon glyphicon-align-justify"/></a><span> Gestion Administrativa</span>
                        </div>
                        <div class="panel-body">
                            <div id="mostrar">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- JSCRIPT -->
        <script src="../bootstrap/js/jquery.js"></script>
        <script src="../jsteps/js/jquery.steps.min.js"></script>
        <script src="../alertify/lib/alertify.min.js"></script>
        <script src="../dtbootstrap/jquery.dataTables.js"></script>
        <script src="../dtbootstrap/dataTables.bootstrap.js"></script>
        <script src="../bootstrap/js/bootstrap-select.js"></script>
        <script src="../bootstrap/js/bootstrap.min.js"></script>
        <script src="../switchboostrap/js/bootstrap-switch.js"></script>
        <script src="../administracion/administracion.js/gestionAdminstrativa.js"></script>
    </body>
</html>
