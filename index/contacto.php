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
        <link href="../index.css/czsale.css" rel="stylesheet" media="screen">
        <link href="../index.css/czsale-responsive.css" rel="stylesheet" media="screen">
        <link href="../alertify/themes/alertify.core.css" rel="stylesheet">
        <link href="../alertify/themes/alertify.default.css" rel="stylesheet">
        <link href="../index.css/bootstrap-reedit.css" rel="stylesheet" media="screen">
        <title>Grupo Chabri - Ayuda</title>
    </head>
    <body>
        <div class="container wrapper">   
            <!-- Logo -->
            <div class="logo">
                <a href="../index.php"><img class="img-responsive" src="index.img/czsale_logo2.png"></a>
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
                    <ul class="nav navbar-nav navbar-right">
                        <!--                        <li class="dropdown">
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Pages <b class="caret"></b></a>
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
                        <li><a href="index.php">Inicio</a></li>
                        <li><a href="ayuda.php">Ayuda</a></li>
                        <li><a href="contacto.php">Contacto</a></li>
                    </ul>
                </div>
            </nav>
            <!-- /Static navbar --> 
            <!-- Content -->
            <div class="row content">
                <div class="col-lg-12">
                    <h2>Contacto</h2>
                    <div class="row">
                        <div class="col-md-8">
                            <iframe src="https://mapsengine.google.com/map/embed?mid=z4AJqEOxN-SI.kBKF4Z8vFTnc" style="border: none; width: 100%; height: 400px;"></iframe>
                        </div>
                        <div class="col-md-4">
                            <div class="well well-sm">
                                <address>
                                    <strong>Twitter, Inc.</strong><br />
                                    795 Folsom Ave, Suite 600<br />
                                    San Francisco, CA 94107<br />
                                    <abbr title="Phone">P:</abbr> (123) 456-7890
                                </address>
                                <address>
                                    <strong>Full Name</strong><br />
                                    <a href="mailto:#">first.last@example.com</a>
                                </address>
                            </div>
                            <div class="well well-sm">
                                <address>
                                    <strong>Twitter, Inc.</strong><br />
                                    795 Folsom Ave, Suite 600<br />
                                    San Francisco, CA 94107<br />
                                    <abbr title="Phone">P:</abbr> (123) 456-7890
                                </address>
                                <address>
                                    <strong>Full Name</strong><br />
                                    <a href="mailto:#">first.last@example.com</a>
                                </address>
                            </div>
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
        <script src="../bootstrap/js/bootstrap.js"></script>
        <script src="index.js/respond.min.js"></script>
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