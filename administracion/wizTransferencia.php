<?php ?>
<!DOCTYPE html>
<html lang="es">
    <body>
        <div id="wizard">
            <h2><span class="glyphicon glyphicon-th-list"/>&numsp;Lista de Transferencias</h2>
            <section style="width: 100%">
                <div id="consultatransferencias">
                </div>
            </section>
            <h2><span class="glyphicon glyphicon-barcode"/>&numsp;Mis Transferencias</h2>
            <section>
                <br>
                <select id="sucursal" class="form-control" style="">
                    <option value="0"> Seleccione una Sucursal</option>
                </select>
                <br>
                <div class="col-sm-3">

                    <div class="input-group" id="panelBusqueda">


                        <input type="text" class="form-control" id="codigoProductoTranferencia" placeholder="Codigo"/>
                        <span class="input-group-btn">
                            <input type="button"  class="btn btn-primary" value="Busqueda Rapida" id="btnbuscador"/>
                            </button>
                        </span> 

                    </div>
                </div>
                <br/>
                <hr>
                <br>
                <form>

                    <table class="table table-striped" id="tablaTransferencias">
                        <thead>
                        <th>Codigo</th>
                        <th>Descripcion</th>
                        <th>Cantidad</th>
                        <th>Cantidad Maxima</th>
                        <th>Precio</th>
                        <th>Total</th>
                        </thead>
                    </table>
                </form>
                <hr>
                <form class="form-inline text-right">
                    <param class="myCodigo" value="inicial">
                    <span>Total : <input type="text" id="costoTotal" class="form-control text-right" style="width: 20%" disabled="true" value="0"/></span>
                </form>
                <form class="form-inline text-right">
                    <input type="button" id="mandarPedido" value="Aceptar"/>
                    <input type="button" id="CancelarPedido" value="Cancelar"/>
                </form>
            </section>
            <h2><span class="glyphicon glyphicon-th-list"/>&numsp;peticiones a transferir</h2>
            <section style="width: 100%">
                <div id="consultapedidos">
                </div>
            </section>
            <h2><span class="glyphicon glyphicon-th-list"/>&numsp;Historial de peticiones </h2>
            <section style="width: 100%">
                <div id="x">
                </div>
            </section>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="mdlDetalleTransferencia" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" style="width: 1000px">
                <div class="modal-content">
                    <div class="modal-header" ">

                        <h4 class="modal-title" id="labelTitulo">Transferencias</h4>
                    </div>
                    <form>
                        <div class="modal-body">
                            <div class="form-group">
                                <div id="mostrartransferencias">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input id="mandarRespuesta" type="button" class="btn btn-default" value="Aceptar Pedido"/>
                                <input id="cancelarPedido" type="button" class="btn btn-default" value="Cancelar Pedido"/>
                                <input id="cancelo" type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar"/>
                                <!--<input id="guardarTarifas" type="button" class="btn btn-primary" data-dismiss="modal" value="Guardar" disabled/>-->
                            </div>
                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </div>
        
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
                        <button type='button' class='btn btn-primary' id='btnver' onclick='listarProductos()'><span class='glyphicon glyphicon-shopping-cart'></span> Listar</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    <script src="../administracion/administracion.js/controlWizard.js"></script>
    <script src="administracion.js/Transferencias.js"></script>
    <script src="administracion.js/requisiciones.js"></script>
</body>
</html>