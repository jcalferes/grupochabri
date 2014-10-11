<?php
include '../index/verificaSessionCliente.php';
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
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-caret-square-o-down"></i>Solicitudes <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li id="13" class=""><a href="javascript:entroClientePedido();">Pedido de compra</a></li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" ><label id="session_nombre"></label>&nbsp;<b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li class="dropdown-header" ><a  href="#" id="perfil">Perfil</a></li>
<!--                                <li class="dropdown-header">Sucursal actual:<br><span id="session_sucursal"></span></li>-->
                                <!--                                <li><a onclick="cambiarSucursal();">Cambiar de sucursal</a></li>
                                                                <li class="divider"></li>-->
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



        <div class="modal fade" id="mdlPerfil" tabindex="-1" 
             role="dialog" aria-labelledby="myModalLabel" 
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Cambiar sucursal</h4>
                    </div>
                    <div class="modal-body" id="contenidoPerfil">

                    </div>
                    <div class="modal-footer">
                    </div>
                </div> 
            </div>  
        </div>





        <!--        <div class="modal fade" id="mdlcamsuc" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="myModalLabel">Cambiar sucursal</h4>
                            </div>
                            <div class="modal-body">
                                <select id="slccamsuc" class="form-control">
                                    <option value="0">Seleccione una Sucursal</option>
                                </select>
                            </div>
                            <div class="modal-footer">
                                <input id="btncamsuc_cancelar" type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar"/>
                                <input id="btncamsuc_cambiar" type="button" class="btn btn-cprimary" value="Cambiar" />
                            </div>
                        </div> /.modal-content 
                    </div> /.modal-dialog 
                </div> /.modal -->
        <!-- JSCRIPT -->
        <script src="../bootstrap/js/jquery.js"></script>
        <script src="../jsteps/js/jquery.steps.min.js"></script>
        <script src="../alertify/lib/alertify.min.js"></script>
        <script src="../dtbootstrap/jquery.dataTables.js"></script>
        <script src="../dtbootstrap/dataTables.bootstrap.js"></script>
        <script src="../bootstrap/js/bootstrap-select.js"></script>
        <script src="../bootstrap/js/bootstrap.min.js"></script>
        <script src="../switchboostrap/js/bootstrap-switch.js"></script>
        <script src="../administracion/administracion.js/gestionAdministrativaClientes.js"></script>
    </body>
</html>
