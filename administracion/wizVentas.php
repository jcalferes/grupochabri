<?php ?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <link href="../dtbootstrap/dataTables.bootstrap.css" rel="stylesheet">
    </head>
    <body>
        <div id="wizard">
            <h2><span class="glyphicon glyphicon-shopping-cart"/>&numsp;Ventas</h2>
            <section>
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
                </div>
                <br>
                <br>
                <form class="form-horizontal" role="form" style="margin-left: 20px">
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-1 control-label">Desc. Factura</label>
                        <div class="col-sm-1">
                            <input type="email" class="form-control" id="inputEmail3" placeholder="Email">
                        </div>
                        <label for="inputEmail3" class="col-sm-2 control-label" style="margin-left: -80px">Desc. Pront.Pag </label>
                        <div class="col-sm-1">
                            <input type="email" class="form-control" id="inputEmail3" placeholder="Email">
                        </div>
                    </div>
                </form>
                <br>
                <!--combo de clientes-->
                <div class="col-sm-3" style="margin-top: -30px">
                    <select class="form-control" id="cmbTipoPago"
                            style="margin-left: 35px; width: 260px">
                        <option></option>
                    </select>
                </div>
                <!--<br/>-->
                <hr>
                <div class="col-sm-3" style="margin-left: 35px">
                    <div class="input-group" id="panelBusqueda">
                        <input type="text" class="form-control" 
                               id="codigoProductoEntradas" 
                               placeholder="Codigo"/>
                        <span class="input-group-btn">
                            <button  class="btn btn-default" type="button" title="Buscar" id="btnbuscador">
                                <span class="glyphicon glyphicon-search"></span>
                            </button>
                        </span> 
                    </div>
                </div>
                <br><br>
                <div style="overflow-x: auto;  height: 180px">
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
                </div>
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

                <input  id="guardarVenta"  type="submit" class="btn btn-primary"/>
            </section>
            <!-- CANCELACIONES -->
            <h2><span class="glyphicon glyphicon-remove-circle"/>&numsp;Cancelaciones</h2>
            <section>
                <form style="margin: 0% 25% 0% 25%">
                    <div id="divfoliocancelacion" class="form-group">
                        <label>Folio:</label>
                        <input type="text" class="form-control" id="txtfoliocancelacion"><br>
                        <input id="btnbuscarfoliocancelacion" type="button" class="btn btn-primary" data-dismiss="modal" value="Buscar"/>
                    </div>
                    <div id="showdatoscancelacion"></div>
                </form>
            </section>
            <!-- TERMINA CACELACIONES -->
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
                        <button type='button' class='btn btn-primary' id='btnver'><span class='glyphicon glyphicon-shopping-cart'></span> Listar</button>
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
             aria-labelledby="myModalLabel" 
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
                                class='btn btn-primary' 
                                id='btnGranel'>
                            <span class='glyphicon glyphicon-shopping-cart'>
                            </span> Listar</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
        <!--final modalGranel-->
        <!--<script src="../administracion/administracion.js/jqueryui.js"></script>-->
        <script src="../administracion/administracion.js/XmlComprobante.js"></script>
        <script src="../administracion/administracion.js/XmlConceptos.js"></script>
        <script src="../administracion/administracion.js/controlWizard.js"></script>
        <script src="../alertify/lib/alertify.min.js"></script>
        <script src="../dtbootstrap/jquery.dataTables.js"></script>
        <script src="../administracion/administracion.js/buscador.js"></script>
        <script src="../administracion/administracion.js/cancelacion.js"></script>
        <script src="administracion.js/Ventas.js"></script>
    </body>
</html>
<!--<input type="text" onkeyup="sumaCantidad(1,2,3);"/>-->
