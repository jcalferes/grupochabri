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
        <input  type="button"  class="btn btn-cprimary" value="Probar" id="btnabonos"/>
        <!--/.modal-->
        <div class="modal fade" id="mdlabonos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
            <div id="mdldialog" class="modal-dialog" style="width: 80%">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Abonos</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group form-inline">
                            <label>Folio:</label><br>
                            
                                <input type="text" class="form-control" id="txtfolioabonos" style="width: 40%"/>
                                <button type="button" class="btn btn-cprimary" id="btnfolioabonos">Buscar</button>
                        </div>
                        <div id="buscabonos">
                        </div>
                        <div id="divabonos">
                            <div class="form-group">
                                <table class="table" style="width: 50%">
                                    <tr>
                                        <td>
                                            <label>Nombre del cliente: </label>
                                            <span id="nombreabono">Nombre</span>
                                        </td>
                                        <td>
                                            <label>RFC: </label>
                                            <span id="rfcabono">RFC</span>
                                        </td>
                                        <td>
                                            <label>Limite de credito: </label>
                                            <span id="creditoabono">Credito</span>
                                        </td>
                                    </tr>
                                </table>
                                <table class="table">
                                    <th>
                                        <label>Credito: </label>
                                        <span id="adeudoabono" >Adeudo</span>
                                    </th>
                                    <th>
                                        <label>Abonos: </label>
                                        <span id="pagadoabono" >Pagado</span>
                                    </th>
                                    <th>
                                        <label>Saldo: </label>
                                        <span id="saldoabono" >Saldo</span>
                                    </th>
                                </table>
                            </div>
                            <div class="well well-sm" >
                                <center><span id="creditopagado" style="color: red; font-size: xx-large" ><strong>Pagado</strong></span></center>
                                <div id="tblabonos" >
                                </div>
                            </div>
                            <form class='form-inline'>
                                <div class="form-group">
                                    <label>*Cantidad a abonar:</label><br>
                                    <input type="number" class="form-control" id="txtcantidadabono" onkeypress="return NumCheck2(event, this);" />
                                </div>
                                <div class="form-group">
                                    <label>*Tipo de pago:</label><br>
                                    <select id="slctipopago" class="selectpicker" data-container="body" data-live-search="true">
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>*Referencia:</label><br>
                                    <input type="text" class="form-control" id="txtreferenciaabono" />
                                </div>
                            </form>
                            <div class="form-group">
                                <br/>
                                <label>Observaciones:</label><br/>
                                <textarea class="form-control" id="txtobservacionesabono"></textarea>
                            </div>
                            <p class="text-muted"><em>*Datos obligatorios para poder abonar</em></p>
                            <hr>
                            <div class="form-group text-right">
                                <button type='button' class='btn btn-default' id='btncancelarabono'>Cancelar abono</button>
                                <button type='button' class='btn btn-cprimary' id='btnabonar'>Registrar abono</button>
                            </div>
                        </div><!-- /.divabonos -->
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
        <script src="../administracion/administracion.js/abonos.js"></script>
    </body>
</html>

