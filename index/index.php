<!DOCTYPE html>

<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="...">
        <meta name="keywords" content="...">
        <meta name="author" content="...">
        <link rel="icon" href="index.img/gc-favicon.png">
        <link href="../bootstrap/css/bootstrap.css" rel="stylesheet" media="screen">
        <link href="../bootstrap/css/bootstrap-theme.css" rel="stylesheet" media="screen">
        <link href="index.css/czsale.css" rel="stylesheet" media="screen">
        <link href="index.css/czsale-responsive.css" rel="stylesheet" media="screen">
        <link href="../alertify/themes/alertify.core.css" rel="stylesheet" media="screen">
        <link href="../alertify/themes/alertify.default.css" rel="stylesheet" media="screen">
        <link href="index.css/bootstrap-reedit.css" rel="stylesheet" media="screen">
        <title>Grupo Chabri</title>
    </head>
    <body>
        <div class="container">
            <!-- Logo -->
            <div class="logo" >
                <a href="index.php" ><img class="img-responsive" src="index.img/czsale_logo2.png"></a>
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
                    <div class="input-group" id="panelBusqueda">
                        <input type="text" class="form-control" 
                               id="txtBusquedaProductosIndex" 
                               placeholder="Busqueda..."/>
                        <span class="input-group-btn">
                            <button  class="btn btn-default" type="button" title="Buscar" id="btnBusquedaProductos">
                                <span class="glyphicon glyphicon-search"></span>
                            </button>
                        </span> 
                    </div>
                    <h4>Categorias</h4>
                    <div id="mostrarcategorias"></div>
                    <h4>Novedades</h4>
                    <div id="mostrarnovedades"></div>
                </div>
                <div class="col-lg-9 content-right">
                    <!--<h4>Slider</h4>-->
                    <div id="panelBusquedaProductos">

                        <div>
                            <div id="mostrarslide"></div>
                            <h4>Recomendado</h4>
                            <div id="mostrarrecomendados"></div>
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
        <script src="index.js/index.js"></script>
        <script src="index.js/busquedaProductos.js"></script>
        <script>
            $(document).ready(function () {
                // Drop down menu handler
                $('.dropdown-menu').find('form').click(function (e) {
                    e.stopPropagation();
                });
                // Slider
                $("#slides").slidesjs({
                    width: 900,
                    height: 300,
                    navigation: false,
                    play: {
                        active: false,
                        effect: "slide",
                        interval: 4000,
                        auto: true,
                        swap: false,
                        pauseOnHover: true,
                        restartDelay: 2500
                    }
                });
            });
        </script>
        <!-- /JS -->
    </body>
</html>