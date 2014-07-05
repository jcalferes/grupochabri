<?php ?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <link href="../dtbootstrap/dataTables.bootstrap.css" rel="stylesheet"/>
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet"/>
        <!--<link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">-->
    </head>
    <body>
        <div id="wizard">
            <h2><span class="glyphicon glyphicon-shopping-cart"/>&numsp;Ventas</h2>
            <section>
                <div class="panel-group" id="accordion">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" class="collapsed">
                                    <strong>Autorización</strong>
                                    <span style="float: right" class="glyphicon glyphicon-chevron-down"></span>
                                </a>
                            </h4>
                        </div>
                        <div id="collapseOne" class="panel-collapse collapse" style="height: 0px;">
                            <div class="panel-body">
                                <input id="btnAutorizacion" class="btn btn-default" type="button" value="Descuentos"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div style="float: right" id="fecha">
                </div>
                <br>
                <div style="float: right">
                    <strong><label style="color: red">Folio: </label><label id="folio"/> 
                    </strong>
                </div>
                <!--<br/>-->
                <div class="col-sm-9">
                    <select class="form-control" 
                            id="cmbClientes"
                            style="margin-left: 35px; width: 260px; float: left">
                    </select>
                    <div id="ordenesCompra" style="float: left; width: 260px;">
                        <br>
                    </div>
                </div>
                <br>
                <br>
                <form class="form-horizontal" role="form" style="margin-left: 20px">
                    <div id="descuentosV">
                    </div>
                </form>
                <br>
                <br>
                <!--combo de clientes-->
                <div class="col-sm-3" style="margin-top: -30px">
                    <select class="form-control" id="cmbTipoPago"
                            style="margin-left: 35px; width: 260px">
                        <option></option>
                    </select>
                    <div id="creditoCliente" style="margin-left: 35px"></div>
                </div>
                <br/>
                <br/>
                <hr>
                <div class="col-sm-3" style="margin-left: 35px">
                    <div class="input-group" id="panelBusqueda">
                        <input type="text" class="form-control" 
                               id="codigoProductoEntradas" 
                               placeholder="Codigo"/>
                        <span class="input-group-btn">
                            <button  class="btn btn-default" type="button" title="Buscar" id="btnbuscadorVentas">
                                <span class="glyphicon glyphicon-search"></span>
                            </button>
                        </span> 
                    </div>
                </div>
                <br><br>
                <table class="table" id="tablaVentas">
                    <thead>
                    <th><center>Codigo</center></th>
                    <th><center>Descripcion</center></th>
                    <th><center>Cantidad</center></th>
                    <th><center>Existencia</center></th>
                    <th><center>Lst. Precio</center></th>
                    <th><center>Precio c/u</center></th>
                    <th><center>Desc.</center></th>
                    <th><center>Eliminar</center></th>
                    <th><center>total</center></th>
                    <th><center>$ Desc.</center></th>
                    <th><center>$ Total c/d.</center></th>
                    </thead>
                </table>
                <hr>
                <form class="form-inline text-right">
                    <span>Sub Total : <input type="text" id="subTotalV" class="form-control text-right" style="width: 20%" disabled="true"/></span>
                </form>
                <form class="form-inline text-right" style="margin-top: 5px">
                    <span>Desc. Total : <input type="text" id="descTotalV" class="form-control text-right" style="width: 20%" disabled="true"/></span>
                </form>
                <form class="form-inline text-right" style="margin-top: 5px">
                    <span>SDA :<input type="text" id="costoTotal" class="form-control text-right" style="width: 20%" disabled="true"/></span>
                </form>
                <!--<br>-->
                <form class="form-inline text-right" style="margin-top: 5px">
                    <span>IVA : <input type="text" id="ivaTotal" class="form-control text-right" style="width: 20%" disabled="true"/></span>
                </form>
                <!--                <br>-->
                <form class="form-inline text-right" style="margin-top: 5px">
                    <span>Total : <input type="text" id="totalVenta" class="form-control text-right" style="width: 20%" disabled="true"/></span>
                </form>

                <input  id="guardarVenta"  type="submit" class="btn btn-cprimary"/>
            </section>
            <!-- CANCELACIONES -->
            <h2><span class="glyphicon glyphicon-remove-circle"/>&numsp;Cancelaciones</h2>
            <section>
                <!--<form style="margin: 0% 25% 0% 25%">-->
                <div style="margin: 0% 25% 0% 25%">
                    <div id="divfoliocancelacion" class="form-group">
                        <label>Folio:</label>
                        <input type="text" class="form-control" id="txtfoliocancelacion"><br>
                        <input id="btnbuscarfoliocancelacion" type="button" class="btn btn-cprimary" data-dismiss="modal" value="Buscar"/>
                    </div>
                    <!--</form>-->
                </div>
                <div id="basedatoscancelacion">
                    <div id="showdatoscancelacion"></div>
                </div>
                <div id="divvalidacancelacion">
                    <input type="button" class="btn btn-cprimary" id="btnvalidacancelacion" value="Efectuar cancelacion">
                    <input type="button" class="btn btn-default" id="btnnocancelacion" value="Descartar">
                </div>
            </section>
            <!--Seccion de Cobranzas-->
            <h2><span class="glyphicon glyphicon-remove-circle"/>&numsp;Cobranzas</h2>
            <section>

                <div>
                    <div style="width: 100%; float: left; margin-left: -10px">
                        <div class="btn-toolbar" role="toolbar" style="float: left">
                            <div class="btn-group">
                                <button  id="btnAbonos" class="btn btn-default" title="Abonar Compra"><i class="fa fa-dollar fa-lg"></i> Abonos</button>
                                <button class="btn btn-default" title="Cancelar Compra"> <i class="fa fa-thumbs-o-down"></i> Cancelaciones</button> 
                                <button class="btn btn-default" title="Rechazar Compra"><i class="fa fa-trash-o fa-lg"></i> Rechazar</button>
                                <button class="btn btn-default" title="Cobrar Compra" id="btnCobrar"> <i class="fa fa-money fa-lg"></i> Cobrar</button> 
                            </div>
                        </div>
                        <div class="input-group" style="width: 20%; float: right">
                            <input type="text" placeholder="N° de folio" class="form-control"/>
                            <span class="input-group-btn">
                                <button class="btn btn-default" id="mdlBuscadorOrdenesCompra" type="button" title="Buscar Ordenes de Compra">
                                    <span class="glyphicon glyphicon-search"></span>
                                </button>
                            </span>
                        </div>
                        <br>
                        <br>
                        <div style="width: 100%" id="informacionPagos">
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <!--MODAL DE BUSQUEDA-->
        <div class="modal fade" id="mdlbuscador" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
            <div class="modal-dialog" style="width: 80%">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Busqueda de productos</h4>
                    </div>
                    <div class="modal-body">
                        <div id="todos" >
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type='button' class='btn btn-cprimary' id='btnver'>Agregar productos seleccionados a la lista</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
        <!-- Modal -->
        <!--Modal Granel-->
        <div class="modal fade" 
             id="mdlGranel" 
             tabindex="-1" 
             role="dialog" 
             aria-labelledby="modalAutorizacion" 
             aria-hidden="true" >
            <div class="modal-dialog" style="width: 300px">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Productos. Granel</h4>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" role="form">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">
                                    Cantidad:
                                </label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <input type="text" 
                                               class="form-control" 
                                               placeholder="kg"
                                               id="txtCantidadModal"
                                               onkeyup="calcularPorCantidad();"/>
                                        <span class='input-group-btn'>
                                            <button class='btn btn-default' type='button'>
                                                KG
                                            </button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">
                                    Pesos:
                                </label>
                                <div class="col-sm-8">
                                    <input type="text" 
                                           class="form-control" 
                                           id="txtTotalModal"
                                           placeholder="$0.00 mxn."
                                           onkeyup="calcularPorPrecio();"/>

                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type='button' 
                                class='btn btn-cprimary' 
                                id='btnGranel'>
                            Agregar</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
        <!--final modalGranel-->
        <!--MODAL DE AUTORIZACION-->
        <div class="modal fade" 
             id="mdlAutorizacion" 
             tabindex="-1" 
             role="dialog" 
             aria-labelledby="modalAutorizacion" 
             aria-hidden="true" >
            <div class="modal-dialog" style="width: 300px">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Autorización</h4>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" role="form">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">
                                    Usuario
                                </label>
                                <div class="col-sm-8">
                                    <!--<div class="input-group">-->
                                    <input type="text" 
                                           class="form-control" 
                                           placeholder="Usuario"
                                           id="txtusuario"
                                           />
                                    <!--<span class='input-group-btn'>-->
                                    <!--                                            <button class='btn btn-default' type='button'>
                                                                                    KG
                                                                                </button>-->
                                    <!--</span>-->
                                    <!--</div>-->
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">
                                    Password:
                                </label>
                                <div class="col-sm-8">
                                    <input type="password" 
                                           class="form-control" 
                                           id="txtPass"
                                           placeholder="Password"
                                           />
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type='button' 
                                class='btn btn-cprimary' 
                                id='btnAutorizar'>
                            Autorizar</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
        <!------------------------------------------------------------------>
        <!--Modal de busqueda de ordenes de Compra-->
        <div class="modal fade" 
             id="mdlBusquedaOrdenCompra" 
             tabindex="-1" 
             role="dialog" 
             aria-labelledby="modalOrdenCompra" 
             aria-hidden="true">
            <div class="modal-dialog" style="width: 300px">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Ordenes de Compra</h4>
                    </div>
                    <div class="modal-body">
                        <table class="table table-hover" id="tableOrdenesCompra">

                        </table>
                    </div>
                    <div class="modal-footer">

                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>

        <!--Modal de cobranza-->
        <div class="modal fade" 
             id="mdlPagar" 
             tabindex="-1" 
             role="dialog" 
             aria-labelledby="modalOrdenCompra" 
             aria-hidden="true">
            <div class="modal-dialog" style="width: 300px">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Ordenes de Compra</h4>
                    </div>
                    <div class="modal-body">
                        Cantiad Ingresada :
                        <center>
                            <input id="txtCantidad" class="form-control" type="text" style="padding: 20px" placeholder="$9999.99 mxn"/>
                        </center>
                    </div>
                    <div class="modal-footer">
                        <input id="btnPagar" type="submit" value="Cobrar" class="btn btn-default"/>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
        <!--fin del modal de cobranzas-->

        <!--Inicio de Modal de abonos-->
        <div class="modal fade" id="mdlabonos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
            <div id="mdldialog" class="modal-dialog" style="width: 80%">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Abonos</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Folio:</label>
                            <input type="text" class="form-control" id="txtfolioabonos" style="width: 40%"/>
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



        <script src="../administracion/administracion.js/XmlComprobante.js"></script>
        <script src="../administracion/administracion.js/XmlConceptos.js"></script>
        <script src="../administracion/administracion.js/controlWizard.js"></script>
        <script src="../alertify/lib/alertify.min.js"></script>
        <script src="../dtbootstrap/jquery.dataTables.js"></script>
        <script src="../administracion/administracion.js/buscador.js"></script>
        <script src="../administracion/administracion.js/cancelacion.js"></script>
        <script src="administracion.js/Ventas.js"></script>
        <script src="administracion.js/pagos.js"></script>
        <script src="../administracion/administracion.js/abonos.js"></script>
    </body>
</html>
<!--<input type="text" onkeyup="sumaCantidad(1,2,3);"/>-->
