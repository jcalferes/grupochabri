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
        <link href="../alertify/themes/alertify.bootstrap.css" rel="stylesheet">
        <!-- CSS personalizados -->
        <link href="../bootstrap/css/misestilos/estilonavbar.css" rel="stylesheet">
    </head>
    <body>
        <div class="navbar navbar-default navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
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
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </div>
        <div class="container">
            <div class="panel panel-default ">
                <div class="panel-heading">
                    <h3 class="panel-title">Gestion Administrativa</h3>
                </div>
                <div class="panel-body text-center">
                    <!--                    Aqui todo el contenido de la pagina-->
                    <div class="row">
                        <input href="#mdlMarca" data-toggle="modal" type="button" class="btn btn-primary" value="Nueva Marca">
                    </div>
                    <button id="muestramdlproducto" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#mdlProducto" style="display: none"></button>
                    <div class="modal fade" id="mdlProducto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div id="formulario">
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div>
                    <!--========================================================-->
                </div>
                <div class="panel-footer">
                    <!--                    Aqui los botones o similares-->

                    <!--========================================================-->
                </div>
            </div>
        </div> <!-- /container -->
        <!-- JSCRIPT -->
        <script src="../bootstrap/js/jquery.js"></script>
        <script src="../bootstrap/js/bootstrap.min.js"></script>
        <script src="../alertify/lib/alertify.min.js"></script>
    </body>
</html>
<?php
include './modalMarca.php';
include './modalDireccion.php';
?>

