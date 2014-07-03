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
        <link href="../bootstrap/css/bootstrap.css" rel="stylesheet" media="screen">
        <link href="../bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
        <link href="../alertify/themes/alertify.core.css" rel="stylesheet" media="screen">
        <link href="../alertify/themes/alertify.default.css" rel="stylesheet" media="screen">
        <link href="../jsteps/css/jquery.steps.css" rel="stylesheet" media="screen">
        <link href="../dtbootstrap/dataTables.bootstrap.css" rel="stylesheet" media="screen">
        <link href="../bootstrap/css/bootstrap-select.css" rel="stylesheet" media="screen">
        <link href="../switchboostrap/css/bootstrap-switch.css" rel="stylesheet" media="screen">
        <link href="administracion.css/gestionAdministrativa.css" rel="stylesheet" media="screen">
        <link href="administracion.css/bootstrap-reedit.css" rel="stylesheet" media="screen">
        <!-- CSS Personalizados-->
    </head>
    <body>
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar" ></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-caret-square-o-down"></i>Productos<b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li class="dropdown-header"></li>
                                <li id="2" class=""><a onclick="entroProducto();">Agregar o editar productos</a></li>
                                <li class="divider"></li>
                                <li class="dropdown-header"></li>
                                <li id="12" class=""><a onclick="entroAgranel();">Incrementar productos a granel</a></li>
                                <li id="4" class=""><a onclick="entroListaPrecio();">Listas de precios</a></li>
                                <li id="1" class=""><a onclick="entroMarca();">Marcas</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-caret-square-o-down"></i> Inventario<b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li class="dropdown-header"></li>
                                <li id="5" class=""><a onclick="entroEntradasProductos();">Entradas de producto</a></li>
                                <li id="7" class=""><a onclick="entroSalidasProduto();">Salidas de producto</a></li>
                                <li id="10" class=""><a onclick="entroVentas();">Ventas</a></li>
                                <li class="divider"></li>
                                <li class="dropdown-header"></li>
                                <li id="6" class=""><a onclick="ordenCompra();">Orden de compra y cotizaciones</a></li>
                                <li id="13" class=""><a onclick="entroClientePedido();">Pedidos de clientes</a></li>
                                <li id="11" class=""><a onclick="entroTrasferencia();">Transferencias</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-caret-square-o-down"></i>Personas<b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li class="dropdown-header"></li>
                                <li id="9" class=""><a onclick="entroCliente();">Clientes</a></li>
                                <li id="3" class=""><a onclick="entroProveedor();">Proveedores</a></li>
                                <li id="8" class=""><a onclick="entroUsuarios();">Usuarios del sistema</a></li>

                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-caret-square-o-down"></i>Publicar<b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li id="15" class=""><a onclick="entroClasificados();">Clasificados</a></li>
                            </ul>
                        </li>

                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a id="donde" href="../index/cerrarSesion.php"></a></li>
<!--<li><a id="donde"></a></li>-->
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div>
        </nav>
        <div class="container-fluid">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <span> Gestion Administrativa</span>
                </div>
                <div class="panel-body">
                    <div id="mostrar">
                        <img class="img-responsive " style="margin: 0 auto; width: 25%" src="administracion.imgs/ChabriLogo.png" alt="">
                    </div>
                    <a href="#" class="scrollUp"></a>
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
