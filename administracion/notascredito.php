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
        <input type="button"  class="btn btn-cprimary" value="Probar" id="btnnotascredito"/>
        <!--/.modal-->
        <div class="modal fade" id="mdlnotascredito" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
            <div id="mdldialog" class="modal-dialog" >
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Notas de credito</h4>
                    </div>
                    <div class="modal-body">
                        <div id="vernotascredito">
                            <input type="button" class="btn btn-cprimary btn-xs" value="+ Nueva nota de credito" id="btnnuevanotacredito"/><hr>
                            <div id="buscanotascredito">
                            </div>
                        </div>
                        <div id="nuevanotacredito">
                            <form>
                                <div class="form-group">
                                    <select id="slccliente" class="selectpicker selectores" data-width="auto" data-container="body" data-live-search="true">
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Cantidad en pesos:</label>
                                    <input type="text" class="form-control" id="txtcantidadnotacredito" onkeypress="return NumCheck2(event, this);"/>
                                </div>
                                <div class="form-group">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" id="chkfoliocancelacion" onclick="vincularcancelacion();"> Vincular a una cancelacion
                                        </label>
                                    </div>
                                    <div id="divfoliocancelacion">
                                        <div class="well well-sm">
                                            <label>Folio  de la cancelación a vincular:</label>
                                            <input type="text" class="form-control" style="width: 50%" id="txtfoliocancelacion"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="button" class="btn btn-cprimary" id="btnguardanotacredito" value="Guardar nota de credito"/>
                                    <input type="button" class="btn btn-default" id="btncancelarnotacredito" value="Cancelar"/>
                                </div>
                            </form>
                        </div>
                    </div>
                </div><!-- /.modal-content -->
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
        <script src="../administracion/administracion.js/notascredito.js"></script>
    </body>
</html>

