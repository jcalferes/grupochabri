<?php
include '../index/verificaSessionSuperadmin.php';
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
                        <li><a href="javascript:entroAdministradores();">Usuarios del sistema</a></li>
                        <li><a href="">Crear nueva sucursal</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" ><label id="session_nombre"></label> <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="../index/cerrarSesion.php"><span class="glyphicon glyphicon-off"></span> Cerrar sesion</a></li>
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
        <script src="../administracion/administracion.js/gestionSuperAdministrativa.js"></script>
    </body>
</html>
