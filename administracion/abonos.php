<?php ?>
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
        <link href="../dtbootstrap/dataTables.bootstrap.css" rel="stylesheet">
        <link href="../alertify/themes/alertify.core.css" rel="stylesheet">
        <link href="../alertify/themes/alertify.default.css" rel="stylesheet">
        <link href="../dtbootstrap/dataTables.bootstrap.css" rel="stylesheet">
        <link href="../bootstrap/css/bootstrap-select.css" rel="stylesheet">
        <!-- CSS Personalizados-->
    </head>
    <body>
        <input type="button"  class="btn btn-primary" value="Probar" id="btnabonos"/>
        <!--/.modal-->
        <div class="modal fade" id="mdlabonos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
            <div class="modal-dialog" style="width: 80%">
                <form>
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title" id="myModalLabel">Abonos</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Folio:</label>
                                <input type="text" class="form-control" id="txtfolioabonos" style="width: 25%"/>
                            </div>
                            <div id="divabonos">
                                <div id="tblabonos" >
                                </div>
                                <div class="form-group">
                                    <label>Cantidad a abonar:</label>
                                    <input type="text" class="form-control" id="txtcantidadabono" style="width: 25%">
                                </div>
                                <div class="form-group">
                                    <label>Tipo de pago:</label><br/>
                                    <select id="slctipopago" class="selectpicker" data-container="body" data-live-search="true">
                                    </select>
                                </div>
                            </div><!-- /.divabonos -->
                        </div>
                        <div class="modal-footer">
                        </div>
                    </div><!-- /.modal-content -->
                </form>
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <!-- JSCRIPT -->
        <script src="../bootstrap/js/jquery.js"></script>
        <script src="../alertify/lib/alertify.min.js"></script>
        <script src="../dtbootstrap/jquery.dataTables.js"></script>
        <script src="../dtbootstrap/dataTables.bootstrap.js"></script>
        <script src="../bootstrap/js/bootstrap.min.js"></script>
        <script src="../bootstrap/js/bootstrap-select.js"></script>
        <script src="../dtbootstrap/jquery.dataTables.js"></script>
        <script src="../administracion/administracion.js/abonos.js"></script>
    </body>
</html>

