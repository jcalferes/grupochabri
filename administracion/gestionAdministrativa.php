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
                padding-top: 50px;
            }
            /*
             * Global add-ons
             */

            .sub-header {
                padding-bottom: 10px;
                border-bottom: 1px solid #eee;
            }


            /*
             * Sidebar
             */

            /* Hide for mobile, show later */
            .sidebar {
                display: none;
            }
            @media (min-width: 768px) {
                .sidebar {
                    position: fixed;
                    top: 51px;
                    bottom: 0;
                    left: 0;
                    z-index: 1000;
                    display: block;
                    padding: 20px;
                    overflow-x: hidden;
                    overflow-y: auto; /* Scrollable contents if viewport is shorter than content. */
                    background-color: #f5f5f5;
                    border-right: 1px solid #eee;
                }
            }

            /* Sidebar navigation */
            .nav-sidebar {
                margin-right: -21px; /* 20px padding + 1px border */
                margin-bottom: 20px;
                margin-left: -20px;
            }
            .nav-sidebar > li > a {
                padding-right: 20px;
                padding-left: 20px;
            }
            .nav-sidebar > .active > a {
                color: #fff;
                background-color: #428bca;
            }


            /*
             * Main content
             */

            .main {
                padding: 20px;
            }
            @media (min-width: 768px) {
                .main {
                    padding-right: 40px;
                    padding-left: 40px;
                }
            }
            .main .page-header {
                margin-top: 0;
            }


            /*
             * Placeholder dashboard ideas
             */

            .placeholders {
                margin-bottom: 30px;
                text-align: center;
            }
            .placeholders h4 {
                margin-bottom: 0;
            }
            .placeholder {
                margin-bottom: 20px;
            }
            .placeholder img {
                display: inline-block;
                border-radius: 50%;
            }
        </style>
    </head>
    <body>
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
                </div><!--/.nav-collapse -->
            </div>
        </div>
        <div class="container" style="width: 100%">
            <div class="row">
                <div class="col-sm-3 col-md-2 sidebar">
                    <ul class="nav nav-sidebar">
                        <li id="1" class=""><a onclick="entroMarca();">Marcas</a></li>
                        <li id="2" class=""><a onclick="entroProducto();">Productos</a></li>
                        <li id="3" class=""><a onclick="entroProveedor();">Proveedores</a></li>
                    </ul>
                    <ul class="nav nav-sidebar">
                        <li id="9" class=""><a onclick="entroCliente();">Clientes</a></li>
                        <li id="4" class=""><a onclick="entroListaPrecio();">Listas</a></li>
                        <li id="10" class=""><a onclick="entroVentas();">Ventas</a></li>
                    </ul>
                    <ul class="nav nav-sidebar">
                        <li id="5" class=""><a onclick="entroEntradasProductos();">Entradas</a></li>
                        <li id="7" class=""><a onclick="entroSalidasProduto();">Salidas</a></li>
                        <li id="11" class=""><a onclick="entroTrasferencia();">Transferencia</a></li>
                        <li id="8" class=""><a onclick="entroUsuarios();">Usuarios</a></li>
                    </ul>
                </div>
                <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                    <!--                    Aqui todo el contenido de la pagina-->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Gestion Administrativa</h3>
                        </div>
                        <div class="panel-body">
                            <div id="mostrar">
                            </div>
                            <!--                    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                                                    <ul class="nav nav-tabs nav-justified">
                                                        <li class="active"><a href="#">Home</a></li>
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
                                                    <div id="mostrar">
                                                    </div>
                                                </div>-->
                            <!--                            <div class="panel-footer">
                                                                                Aqui los botones o similares
                                                            ========================================================
                                                        </div>-->
                        </div>
                        <!--========================================================-->
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
