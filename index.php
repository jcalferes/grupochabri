<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="...">
        <meta name="keywords" content="...">
        <meta name="author" content="...">
        <link href="bootstrap/css/bootstrap.css" rel="stylesheet" media="screen">
        <link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
        <link href="index/index.css/czsale.css" rel="stylesheet" media="screen">
        <link href="index/index.css/czsale-responsive.css" rel="stylesheet" media="screen">
        <link href="alertify/themes/alertify.core.css" rel="stylesheet">
        <link href="alertify/themes/alertify.default.css" rel="stylesheet">
        <link href="index/index.css/bootstrap-reedit.css" rel="stylesheet" media="screen">
        <title>Grupo Chabri</title>
    </head>
    <body>
        <div class="container wrapper">   
            <!-- Logo -->
            <div class="logo">
                <a href="index.html"><img class="img-responsive" src="index/index.img/czsale_logo.png"></a>
            </div>
            <!-- /Logo -->  
            <!-- Static navbar -->
            <nav class="navbar navbar-default" role="navigation">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#czsale-navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse" id="czsale-navbar">
                    <!--<a href="addClassified.html" class="btn btn-success navbar-btn add-classified-btn navbar-left" role="button">Add classified</a>-->
                    <ul class="nav navbar-nav navbar-right">
                        <!--                        <li class="dropdown">
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Páginas<b class="caret"></b></a>
                                                    <ul class="dropdown-menu">
                                                        <li><a href="index.html">Home page</a></li>
                                                        <li><a href="addClassified.html">Add classified</a></li>
                                                        <li><a href="category.html">Category page</a></li>
                                                        <li><a href="detail.html">Classified detail</a></li>
                                                        <li><a href="conditions.html">Rules & Conditions</a></li>
                                                        <li><a href="help.html">Help (FAQ)</a></li>
                                                        <li><a href="contact.html">Contact</a></li>
                                                        <li><a href="signUp.html">Sign Up</a></li>
                                                    </ul>
                                                </li>-->
                        <li><a href="index/ayuda.php">Ayuda</a></li>
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
                    <!--                    <h4>Buscar</h4>
                                        <div class="well well-sm">
                                            <form>
                                                <fieldset>
                                                    <input type="text" class="form-control" />
                                                    <small><a href="#" class="btn-advanced-search">Advanced</a></small>
                                                    <input type="submit" class="btn btn-danger btn-sm btn-search" value="Search" />
                                                </fieldset>
                                            </form>
                                        </div>-->
                    <h4>Categorias</h4>
                    <div class="list-group categories">
                        <a href="#" class="list-group-item">Books <span class="glyphicon glyphicon-chevron-right"></span></a>
                        <a href="#" class="list-group-item">Cameras & Photo <span class="glyphicon glyphicon-chevron-right"></span></a>
                        <a href="#" class="list-group-item">Cell Phones & Accessories <span class="glyphicon glyphicon-chevron-right"></span></a>
                        <a href="#" class="list-group-item">Clothing, Shoes & Accessories <span class="glyphicon glyphicon-chevron-right"></span></a>
                        <a href="#" class="list-group-item">Computers & Networking <span class="glyphicon glyphicon-chevron-right"></span></a>
                        <a href="#" class="list-group-item">DVDs & Movies <span class="glyphicon glyphicon-chevron-right"></span></a>
                        <a href="#" class="list-group-item">Health & Beauty <span class="glyphicon glyphicon-chevron-right"></span></a>
                        <a href="#" class="list-group-item">Music <span class="glyphicon glyphicon-chevron-right"></span></a>
                        <a href="#" class="list-group-item">Toys & Hobbies <span class="glyphicon glyphicon-chevron-right"></span></a>
                    </div>
                    <h4>Novedades</h4>
                    <div class="newest-classifieds">
                        <div class="media">
                            <a class="pull-left" href="#">
                                <img class="media-object" style="width: 64px; height: 64px;" src="http://placehold.it/64x64/e0e0e0" />
                            </a>
                            <div class="media-body">
                                <p><a href="#"><strong>Samsung Galaxy S4</strong></a></p>
                                <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel ...</p>
                            </div>
                        </div>
                        <div class="media">
                            <a class="pull-left" href="#">
                                <img class="media-object" style="width: 64px; height: 64px;" src="http://placehold.it/64x64/e0e0e0" />
                            </a>
                            <div class="media-body">
                                <p><a href="#"><strong>Vizio 60" Slim Frame 3D LED</strong></a></p>
                                <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel ...</p>
                            </div>
                        </div>
                        <div class="media">
                            <a class="pull-left" href="#">
                                <img class="media-object" style="width: 64px; height: 64px;" src="http://placehold.it/64x64/e0e0e0" />
                            </a>
                            <div class="media-body">
                                <p><a href="#"><strong>Apple McBook Pro</strong></a></p>
                                <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel ...</p>
                            </div>
                        </div>
                        <p class="text-right show-more"><a href="#">More &rarr;</a></p>
                    </div>
                </div>
                <div class="col-lg-9 content-right">
                    <h4>Novedades</h4>
                    <div id="slides">
                        <img src="index/index.img/slides/slide-00.jpg">
                        <img src="index/index.img/slides/slide-01.jpg">
                        <img src="index/index.img/slides/slide-02.jpg">
                        <a href="#" class="slidesjs-previous slidesjs-navigation"><i class="icon-chevron-left icon-large"></i></a>
                        <a href="#" class="slidesjs-next slidesjs-navigation"><i class="icon-chevron-right icon-large"></i></a>
                    </div>
                    <h4>Recomendado</h4>
                    <div class="row selected-classifieds">
                        <div class="col-lg-3">
                            <div class="thumbnail">
                                <img src="http://placehold.it/800x600/e0e0e0" />
                                <div class="caption">
                                    <p><small><a href="#">Samsung Galaxy S4</a></small><p>
                                    <p><strong>550 EUR</strong></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="thumbnail">
                                <img src="http://placehold.it/800x600/e0e0e0" />
                                <div class="caption">
                                    <p><small><a href="#">Vizio 60" Slim Frame 3D LED</a></small><p>
                                    <p><strong>370 EUR</strong></p>                 
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="thumbnail">
                                <img src="http://placehold.it/800x600/e0e0e0" />
                                <div class="caption">
                                    <p><small><a href="#">Logitech 2.1 HS-263</a></small><p>
                                    <p><strong>36 EUR</strong></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="thumbnail">
                                <img src="http://placehold.it/800x600/e0e0e0" />
                                <div class="caption">
                                    <p><small><a href="#">Apple McBook Pro</a></small><p>
                                    <p><strong>740 EUR</strong></p>                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row selected-classifieds">
                        <div class="col-lg-3">
                            <div class="thumbnail">
                                <img src="http://placehold.it/800x600/e0e0e0" />
                                <div class="caption">
                                    <p><small><a href="#">Adidas Blake 46"</a></small><p>
                                    <p><strong>55 EUR</strong></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="thumbnail">
                                <img src="http://placehold.it/800x600/e0e0e0" />
                                <div class="caption">
                                    <p><small><a href="#">Card reader MobileLite G2</a></small><p>
                                    <p><strong>10 EUR</strong></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="thumbnail">
                                <img src="http://placehold.it/800x600/e0e0e0" />
                                <div class="caption">
                                    <p><small><a href="#">Electonics toolkit (40 pieces)</a></small><p>
                                    <p><strong>28 EUR</strong></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="thumbnail">
                                <img src="http://placehold.it/800x600/e0e0e0" />
                                <div class="caption">
                                    <p><small><a href="#">Nokia Lumia 800</a></small><p>
                                    <p><strong>185 EUR</strong></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Content -->
            <div class="footer">
                <!--                <div class="well well-sm">
                                    <div class="pull-left">
                                        <ul class="nav nav-pills">
                                            <li><a href="addClassified.html"><span class="glyphicon glyphicon-plus"></span> Add classified</a></li>
                                        </ul>
                                    </div>
                                    <div class="pull-right">
                                        <ul class="nav nav-pills">
                                            <li><a href="">Ayuda</a></li>
                                            <li><a href="">Contacto</a></li>
                                        </ul>
                                    </div>
                                    <div class="clearfix">&nbsp;</div>
                                </div>-->
                <div class="pull-right">
                    <p class="text-muted"><small>Copyright &copy; 2013-2014, PC-Oriente - Todos los derechos reservados.</small></p>
                </div>
            </div>
        </div>
        <!-- JS -->
        <script src="bootstrap/js/jquery.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script src="index/index.js/respond.min.js"></script>
        <script src="index/index.js/jquery.slides.min.js"></script>
        <script src="alertify/lib/alertify.min.js"></script>
        <script src="index/index.js/index.js"></script>
        <script>
            $(document).ready(function() {
                // Drop down menu handler
                $('.dropdown-menu').find('form').click(function(e) {
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
<!--<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="shortcut icon" href="">
        <title>Grupo Chabri</title>
         CSS 
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="alertify/themes/alertify.core.css" rel="stylesheet">
        <link href="alertify/themes/alertify.default.css" rel="stylesheet">
        <link href="dtbootstrap/dataTables.bootstrap.css" rel="stylesheet">
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
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Iniciar Sesion<b class="caret"></b></a>
                            <div class="dropdown-menu" style="width: 320px">
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
                            </div>
                        </li>
                    </ul>
                </div>/.nav-collapse 
            </div>
        </div>
        <div class="container">
                        <div class="panel panel-default">
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
                        </div>
        </div>  /container 
         JSCRIPT 
        <script src="bootstrap/js/jquery.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script src="alertify/lib/alertify.min.js"></script>
        <script src="index/index.js/index.js"></script>
    </body>
</html>-->
