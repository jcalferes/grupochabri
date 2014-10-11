<?php
include '../index/verificaSession.php';
$verificasession = new verificaSession();
$verificasession->validaSesion();
?>
<!DOCTYPE html>
<html lang="es"> 
    <head>
        <meta charset="utf-8">
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
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
    <body style="background-color: whitesmoke">

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
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-caret-square-o-down"></i>Productos <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li class="dropdown-header"></li>
                                <li id="2" class=""><a href="javascript:entroProducto();">Agregar o editar productos</a></li>
                                <li class="divider"></li>
                                <li class="dropdown-header"></li>
                                <li id="12" class=""><a href="javascript:entroAgranel();">Incrementar productos a granel</a></li>
                                <li id="4" class=""><a href="javascript:entroListaPrecio();">Listas de precios</a></li>
                                <li id="1" class=""><a href="javascript:entroMarca();">Marcas</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-caret-square-o-down"></i>Inventario <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li class="dropdown-header"></li>
                                <li id="5" class=""><a href="javascript:entroEntradasProductos();">Entradas de producto</a></li>
                                <!--<li id="7" class=""><a href="javascript:entroSalidasProduto();">Salidas de producto</a></li>-->
                                <li id="10" class=""><a href="javascript:entroVentas();">Ventas</a></li>
                                <li class="divider"></li>
                                <li class="dropdown-header"></li>
                                <li id="6" class=""><a href="javascript:ordenCompra();">Orden de compra y cotizaciones</a></li>
                                <!--<li id="13" class=""><a href="javascript:entroClientePedido();">Pedidos de clientes</a></li>-->
                                <li id="11" class=""><a href="javascript:entroTrasferencia();">Transferencias</a></li>
                                <li id="16" class=""><a href="javascript:entroReportes();">Reportes</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-caret-square-o-down"></i>Personas <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li class="dropdown-header"></li>
                                <li id="9" class=""><a href="javascript:entroCliente();">Clientes</a></li>
                                <li id="3" class=""><a href="javascript:entroProveedor();">Proveedores</a></li>
                                <li id="8" class=""><a href="javascript:entroUsuarios();">Usuarios del sistema</a></li>

                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-caret-square-o-down"></i>Publicar <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li id="15" class=""><a href="javascript:entroClasificados();">Clasificados</a></li>
                            </ul>
                        </li>

                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" ><label id="session_nombre"></label> <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                               
                                <li class="dropdown-header" >Sucursal actual:<br><span id="session_sucursal"></span></li>
                                <li class="divider"></li>
                                <li><a href="../index/cerrarSesion.php">Cerrar session</a></li>
                            </ul>
                        </li>
                        <!--<li><a id="donde" href="../index/cerrarSesion.php"></a></li>-->
                        <!--                        <li><a id="donde"></a></li>-->
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div>
        </nav>
        <div class="container-fluid">
            <div class="panel panel-default">
                <div class="panel-heading">
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
        <script src="../bootstrap/js/jquery-ui.js"></script>
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
