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
        <link href="index.css/czsale-responsive.css" rel="stylesheet" media="screen">
        <link href="index.css/czsale-carousel.css" rel="stylesheet" media="screen">
        <link href="../alertify/themes/alertify.core.css" rel="stylesheet">
        <link href="../alertify/themes/alertify.default.css" rel="stylesheet">
        <link href="index.css/bootstrap-reedit.css" rel="stylesheet" media="screen">
        <title>Grupo Chabri - Detalles de producto</title>
    </head>
    <body>
        <div class="container wrapper">   
            <!-- Logo -->
            <div class="logo">
                <a href="index.html"><img class="img-responsive" src="index.img/czsale_logo2.png"></a>
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
                        <li><a href="ayuda.php">Ayuda</a></li>
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
                    <h4>Categories</h4>
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
                    <h4>Newest classifieds</h4>
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
                    <ol class="breadcrumb">
                        <li><a href="index.html">Home</a></li>
                        <li><a href="#">Categories</a></li>
                        <li><a href="#">Cell Phones & Accessories</a></li>
                        <li><a href="#">Smartphones</a></li>
                    </ol>
                    <h2>Samsung Galaxy S4</h2>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-12" id="slider">
                                    <div class="col-md-12" id="carousel-bounding-box" style="padding: 0;">
                                        <div id="detailCarousel" class="carousel slide">
                                            <div class="carousel-inner">
                                                <div class="active item" data-slide-number="0">
                                                    <img src="index.img/classifieds/galaxy-s4.jpg" class="img-responsive" />
                                                </div>
                                                <div class="item" data-slide-number="1">
                                                    <img src="http://placehold.it/1024x768/e0e0e0/&text=Image+2" class="img-responsive" />
                                                </div>
                                                <div class="item" data-slide-number="2">
                                                    <img src="http://placehold.it/1024x768/e0e0e0/&text=Image+3" class="img-responsive" />
                                                </div>
                                                <div class="item" data-slide-number="3">
                                                    <img src="http://placehold.it/1024x768/e0e0e0/&text=Image+4" class="img-responsive" />
                                                </div>
                                                <div class="item" data-slide-number="4">
                                                    <img src="http://placehold.it/1024x768/e0e0e0/&text=Image+5" class="img-responsive" />
                                                </div>
                                            </div>
                                            <a class="carousel-control left" href="#detailCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
                                            <a class="carousel-control right" href="#detailCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 hidden-sm hidden-xs" id="slider-thumbs">
                                    <ul class="list-inline">
                                        <li><a id="carousel-selector-0" class="selected"><img src="index.img/classifieds/galaxy-s4.jpg" class="img-responsive" /></a></li>
                                        <li> <a id="carousel-selector-1"><img src="http://placehold.it/1024x768/e0e0e0/&text=Image+2" class="img-responsive" /></a></li>
                                        <li> <a id="carousel-selector-2"><img src="http://placehold.it/1024x768/e0e0e0/&text=Image+3" class="img-responsive" /></a></li>
                                        <li> <a id="carousel-selector-3"><img src="http://placehold.it/1024x768/e0e0e0/&text=Image+4" class="img-responsive" /></a></li>
                                        <li> <a id="carousel-selector-4"><img src="http://placehold.it/1024x768/e0e0e0/&text=Image+5" class="img-responsive" /></a></li>
                                    </ul>    
                                </div> 
                            </div> 
                        </div>
                        <div class="col-md-4">
                            <table class="table table-condensed table-hover">
                                <thead>
                                <th colspan="2">Details:</th>
                                </thead>
                                <tbody style="font-size: 12px;">
                                    <tr>
                                        <td>Classified ID</td>
                                        <td>012345</td>
                                    </tr>
                                    <tr>
                                        <td>Price</td>
                                        <td>550 EUR</td>
                                    </tr>
                                    <tr>
                                        <td>Status</td>
                                        <td>New</td>
                                    </tr>
                                    <tr>
                                        <td>Brand</td>
                                        <td>Samsung</td>
                                    </tr>
                                    <tr>
                                        <td>Type</td>
                                        <td>Cell Phone</td>
                                    </tr>
                                    <tr>
                                        <td>Shipping</td>
                                        <td>US, UK, CZ</td>
                                    </tr>
                                    <tr>
                                        <td>Returns</td>
                                        <td>14 days money back</td>
                                    </tr>
                                    <tr>
                                        <td>Payments</td>
                                        <td>PayPal, Credit Card</td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="row">
                                <div class="col-md-12">
                                    <span style="padding-left: 5px;"><strong>Seller:</strong></span>
                                    <div class="well">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <h4><a href="#">Novak Jan</a></h4>
                                                <small>Rating: <span class="glyphicon glyphicon-star"></span> <span class="glyphicon glyphicon-star"></span> <span class="glyphicon glyphicon-star"></span> <span class="glyphicon glyphicon-star"></span> <span class="glyphicon glyphicon-star-empty"></span></small><br />
                                                <small>Location: <cite title="Prague, Czech Republic">Prague, Czech Republic <span class="glyphicon glyphicon-map-marker"></span></cite></small><br />
                                                <span class="glyphicon glyphicon-envelope"></span> email@example.com<br />
                                                <span class="glyphicon glyphicon-phone-alt"></span> +420 123 456 789<br />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>  
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h4>Description</h4>
                            <p style="text-align: justify;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean at nisl sed nibh ornare pretium. Maecenas tincidunt elementum massa, vitae ultrices ligula viverra et. Phasellus cursus diam non semper iaculis. Maecenas cursus commodo augue id dignissim. Etiam eget ante odio. Suspendisse imperdiet purus purus, ut pellentesque lorem pharetra vitae. Cras sed tortor id tellus rutrum dictum. Morbi viverra urna nec metus pretium, sed ultrices lorem dictum. Nullam mattis turpis dapibus massa molestie.</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <h4>Send message to seller</h4>
                            <div class="panel panel-default">
                                <div class="panel-body">                
                                    <form action="#" method="POST">
                                        <div class="form-group">
                                            <label for="InputEmail">Email address</label>
                                            <input type="email" class="form-control" id="InputEmail" placeholder="Enter your email">
                                        </div>
                                        <div class="form-group">
                                            <label for="InputText">Your text</label>
                                            <textarea class="form-control" id="InputText" name="message" placeholder="Type in your message" rows="5" style="margin-bottom:10px;"></textarea>
                                        </div>
                                        <button class="btn btn-info" type="submit">Send</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Content -->
            <div class="footer">
                <div class="well well-sm">
                    <div class="pull-left">
                        <ul class="nav nav-pills">
                            <li><a href="addClassified.html"><span class="glyphicon glyphicon-plus"></span> Add classified</a></li>
                        </ul>
                    </div>
                    <div class="pull-right">
                        <ul class="nav nav-pills">
                            <li><a href="help.html">Help</a></li>
                            <li><a href="contact.html">Contact</a></li>
                            <li><a href="conditions.html">Rules & conditions</a></li>
                        </ul>
                    </div>
                    <div class="clearfix">&nbsp;</div>
                </div>
                <div class="pull-right">
                    <p class="text-muted"><small>Copyright &copy; 2013-2014, SenseMedia.cz - All Rights Reserved.</small></p>
                </div>
            </div>
        </div>
        <!-- JS -->
        <script src="../bootstrap/js/jquery.js"></script>
        <script src="../bootstrap/js/bootstrap.min.js"></script>
        <script src="index.js/respond.min.js"></script>
        <script src="index.js/jquery.slides.min.js"></script>
        <script src="../alertify/lib/alertify.min.js"></script>
        <script>
            $(document).ready(function() {
                // Drop down menu handler
                $('.dropdown-menu').find('form').click(function(e) {
                    e.stopPropagation();
                });
                // Carousel (slider)
                $('#detailCarousel').carousel({
                    interval: 4000
                });
                $('[id^=carousel-selector-]').click(function() {
                    var id_selector = $(this).attr("id");
                    var id = id_selector.substr(id_selector.length - 1);
                    id = parseInt(id);
                    $('#detailCarousel').carousel(id);
                    $('[id^=carousel-selector-]').removeClass('selected');
                    $(this).addClass('selected');
                });
                $('#detailCarousel').on('slid', function(e) {
                    var id = $('.item.active').data('slide-number');
                    id = parseInt(id);
                    $('[id^=carousel-selector-]').removeClass('selected');
                    $('[id^=carousel-selector-' + id + ']').addClass('selected');
                });
            });
        </script>
        <!-- /JS -->
    </body>
</html>