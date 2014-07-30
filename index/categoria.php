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
                <a href="../index.php"><img class="img-responsive" src="index.img/czsale_logo2.png"></a>
            </div>
            <!-- /Logo -->  
            <!-- Static navbar -->
            <nav class="navbar navbar-default" role="navigation" style="border-radius: 0px 0px 5px 5px; border: 3px solid #e7481c;">
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
                <div class="col-lg-3 content-left">
                    <h4>Categorias</h4>
                    <div id="mostrarsubcategorias"></div>
                    <h4>Novedades</h4>
                    <div id="mostrarnovedades"></div>
                </div>
                <div class="col-lg-9 content-right">
                    <div class="row classifieds-table">
                        <div id="cachibaches"></div>
<!--                        <div class="col-lg-12">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th class="text-center">Price</th>
                                        <th class="text-center">Views</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="col-sm-8 col-md-6">
                                            <div class="media">
                                                <a class="thumbnail pull-left" href="#">
                                                    <img class="media-object" src="http://placehold.it/72x72/e0e0e0" style="width: 72px; height: 72px;" />
                                                </a>
                                                <div class="media-body">
                                                    <h4 class="media-heading"><a href="#">Product name</a></h4>
                                                    <p><small>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla adipiscing tempor ornare. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac ...</small></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="col-sm-1 col-md-1 text-center" style="vertical-align: middle;"><strong>110.87 EUR</strong></td>
                                        <td class="col-sm-1 col-md-1 text-center" style="vertical-align: middle;">76x</td>
                                    </tr>
                                    <tr>
                                        <td class="col-sm-8 col-md-6">
                                            <div class="media">
                                                <a class="thumbnail pull-left" href="#">
                                                    <img class="media-object" src="http://placehold.it/72x72/e0e0e0" style="width: 72px; height: 72px;" />
                                                </a>
                                                <div class="media-body">
                                                    <h4 class="media-heading"><a href="#">Product name</a></h4>
                                                    <p><small>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla adipiscing tempor ornare. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac ...</small></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="col-sm-1 col-md-1 text-center" style="vertical-align: middle;"><strong>110.87 EUR</strong></td>
                                        <td class="col-sm-1 col-md-1 text-center" style="vertical-align: middle;">76x</td>
                                    </tr>
                                    <tr>
                                        <td class="col-sm-8 col-md-6">
                                            <div class="media">
                                                <a class="thumbnail pull-left" href="#">
                                                    <img class="media-object" src="http://placehold.it/72x72/e0e0e0" style="width: 72px; height: 72px;" />
                                                </a>
                                                <div class="media-body">
                                                    <h4 class="media-heading"><a href="#">Product name</a></h4>
                                                    <p><small>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla adipiscing tempor ornare. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac ...</small></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="col-sm-1 col-md-1 text-center" style="vertical-align: middle;"><strong>110.87 EUR</strong></td>
                                        <td class="col-sm-1 col-md-1 text-center" style="vertical-align: middle;">76x</td>
                                    </tr>
                                    <tr>
                                        <td class="col-sm-8 col-md-6">
                                            <div class="media">
                                                <a class="thumbnail pull-left" href="#">
                                                    <img class="media-object" src="http://placehold.it/72x72/e0e0e0" style="width: 72px; height: 72px;" />
                                                </a>
                                                <div class="media-body">
                                                    <h4 class="media-heading"><a href="#">Product name</a></h4>
                                                    <p><small>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla adipiscing tempor ornare. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac ...</small></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="col-sm-1 col-md-1 text-center" style="vertical-align: middle;"><strong>110.87 EUR</strong></td>
                                        <td class="col-sm-1 col-md-1 text-center" style="vertical-align: middle;">76x</td>
                                    </tr>
                                    <tr>
                                        <td class="col-sm-8 col-md-6">
                                            <div class="media">
                                                <a class="thumbnail pull-left" href="#">
                                                    <img class="media-object" src="http://placehold.it/72x72/e0e0e0" style="width: 72px; height: 72px;" />
                                                </a>
                                                <div class="media-body">
                                                    <h4 class="media-heading"><a href="#">Product name</a></h4>
                                                    <p><small>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla adipiscing tempor ornare. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac ...</small></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="col-sm-1 col-md-1 text-center" style="vertical-align: middle;"><strong>110.87 EUR</strong></td>
                                        <td class="col-sm-1 col-md-1 text-center" style="vertical-align: middle;">76x</td>
                                    </tr>
                                    <tr>
                                        <td class="col-sm-8 col-md-6">
                                            <div class="media">
                                                <a class="thumbnail pull-left" href="#">
                                                    <img class="media-object" src="http://placehold.it/72x72/e0e0e0" style="width: 72px; height: 72px;" />
                                                </a>
                                                <div class="media-body">
                                                    <h4 class="media-heading"><a href="#">Product name</a></h4>
                                                    <p><small>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla adipiscing tempor ornare. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac ...</small></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="col-sm-1 col-md-1 text-center" style="vertical-align: middle;"><strong>110.87 EUR</strong></td>
                                        <td class="col-sm-1 col-md-1 text-center" style="vertical-align: middle;">76x</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-lg-12" style="text-align: center;">
                            <ul class="pagination">
                                <li class="disabled"><a href="#">«</a></li>
                                <li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">4</a></li>
                                <li><a href="#">5</a></li>
                                <li><a href="#">»</a></li>
                            </ul>
                        </div>-->
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