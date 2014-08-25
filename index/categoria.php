<?php
$id_grupo = $_GET["id_grupo"];
$nm_grupo = $_GET["nm_grupo"];
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="...">
        <meta name="keywords" content="...">
        <meta name="author" content="...">
        <link href="../bootstrap/css/bootstrap.css" rel="stylesheet" media="screen">
        <link href="../bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
        <link href="index.css/czsale.css" rel="stylesheet" media="screen">
        <link href="index.css/czsale-responsive.css" rel="stylesheet" media="screen">
        <link href="../dtbootstrap/dataTables.bootstrap.css" rel="stylesheet" media="screen">
        <link href="../alertify/themes/alertify.core.css" rel="stylesheet">
        <link href="../alertify/themes/alertify.default.css" rel="stylesheet">
        <link href="index.css/bootstrap-reedit.css" rel="stylesheet" media="screen">
        <title>Grupo Chabri - Categoria</title>
    </head>
    <body>
        <input type="text" id="buzon_id" value="<?php echo $id_grupo ?>" hidden=""/>
        <input type="text" id="buzon_nm" value="<?php echo $nm_grupo ?>" hidden=""/>
        <div class="container wrapper">   
            <!-- Logo -->
            <div class="logo">
                <a href="index.php"><img class="img-responsive" src="index.img/czsale_logo2.png"></a>
            </div>
            <!-- /Logo -->  
            <!-- Static navbar -->
            <nav class="navbar navbar-default" role="navigation" style="border-radius: 0px 0px 5px 5px; border: 1px solid #e7481c;">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#czsale-navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse" id="czsale-navbar">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="index.php">Inicio</a></li>
                        <li><a href="ayuda.php">Ayuda</a></li>
                        <li><a href="contacto.php">Contacto</a></li>
                        <!--<li><a href="">Registrarse</a></li>-->
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Iniciar sesion <b class="caret"></b></a>
                            <ul class="dropdown-menu" style="padding: 15px;min-width: 250px;">
                                <li>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <form class="form" role="form" accept-charset="UTF-8" id="login-nav">
                                                <div class="form-group">
                                                    <label class="sr-only" for="exampleInputEmail2">Usuario</label>
                                                    <input type="text" class="form-control" id="loginuser" placeholder="Usuario" required>
                                                </div>
                                                <div class="form-group">
                                                    <label class="sr-only" for="exampleInputPassword2">Contraseña</label>
                                                    <input type="password" class="form-control" id="loginpass" placeholder="Contraseña" required>
                                                </div>
                                                <div class="form-group">
                                                    <button type="button" class="btn btn-cprimary btn-block" id="loginbtn">Acceder</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
            <!-- /Static navbar --> 
            <!-- Content -->
            <div class="row content">
                <div class="col-lg-3 content-left">
                    <h4>Categorias</h4>
                    <div id="mostrarsubcategorias"></div>
                    <h4>Novedades</h4>
                    <div id="mostrarnovedades"></div>
                </div>
                <div class="col-lg-9 content-right">
                    <div class="row classifieds-table">
                        <div id="cachibaches">
                            
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Content -->
            <div class="footer">
                <div class="pull-right">
                    <p class="text-muted"><small>Copyright &copy; 2013-2014, PC-Oriente - Todos los derechos reservados.</small></p>
                </div>
            </div>
        </div>
        <!-- JS -->
        <script src="../bootstrap/js/jquery.js"></script>
        <script src="../bootstrap/js/bootstrap.min.js"></script>
        <script src="index.js/respond.min.js"></script>
        <script src="index.js/jquery.slides.min.js"></script>
        <script src="../alertify/lib/alertify.min.js"></script>
        <script src="../dtbootstrap/jquery.dataTables.js"></script>
        <script src="../dtbootstrap/dataTables.bootstrap.js"></script>
        <script src="index.js/categoria.js"></script>
        <script>
            $(document).ready(function() {
                // Drop down menu handler
                $('.dropdown-menu').find('form').click(function(e) {
                    e.stopPropagation();
                });
            });
        </script>
        <!-- /JS -->
    </body>
</html>
