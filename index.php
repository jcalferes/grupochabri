<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="shortcut icon" href="">
        <title>Grupo Chabri</title>
        <!-- CSS -->
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">
        <link href="alertify/themes/alertify.core.css" rel="stylesheet">
        <link href="alertify/themes/alertify.default.css" rel="stylesheet">
        <link href="dtbootstrap/dataTables.bootstrap.css" rel="stylesheet">
    </head>
    <body>
        <div class="navbar navbar-default" role="navigation">
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
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Iniciar Sesion<b class="caret"></b></a>
                            <ul class="dropdown-menu" style="width: 320px">
                                <form class="form-signin text-center" style="padding: 10px">
                                    <div class="input-group" style="margin: 0% 5% 3% 5%">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                                        <input type="text" id="loginuser" class="form-control" placeholder="Usuario" >
                                    </div>
                                    <div class="input-group" style="margin: 0% 5% 5% 5%">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                                        <input type="password" id="loginpass" class="form-control" placeholder="Password" >
                                    </div>
                                    <input type="button" id="loginbtn" class="btn btn-primary" style="width: 50%; margin: 0% 0% 0% 0%" value="Iniciar"/>
                                </form>
                            </ul>
                        </li>
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </div>
        <div class="container">
            <!--            <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Aqui el titulo de la pagina</h3>
                            </div>
                            <div class="panel-body">
                                                    Aqui todo el contenido de la pagina
            
                                ========================================================
                            </div>
                            <div class="panel-footer">
                                                    Aqui los botones o similares
            
                                ========================================================
                            </div>
                        </div>-->
        </div> <!-- /container -->
        <!-- JSCRIPT -->
        <script src="bootstrap/js/jquery.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script src="alertify/lib/alertify.min.js"></script>
        <script src="index/index.js/index.js"></script>
    </body>
</html>
