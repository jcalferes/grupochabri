<?php ?>
<!DOCTYPE html>
<html lang="es">
    <body>
        <div id="wizard">
            <h2><span class="glyphicon glyphicon-list-alt"/>&numsp;Tranferencias solicitadas</h2>
            <section style="width: 100%">
                <div id="consultatransferencias">
                </div>
            </section>
            <h2><span class="glyphicon glyphicon-refresh"/>&numsp;Nueva solicitud de transferencia</h2>
            <section>
                <div class="form-group">
                    <select id="sucursal" class="form-control" style="width: 30%">
                        <option value="0"> Seleccione una Sucursal</option>
                    </select>
                </div>
                <div class="form-group">
                    <div class="input-group" id="panelBusqueda" style="width: 30%">
                        <input type="text" class="form-control" id="codigoProductoTranferencia" placeholder="Codigo" />
                        <span class="input-group-btn">
                            <input type="button"  class="btn btn-cprimary" value="Busqueda Rapida" id="btnbuscador"/>
                            </button>
                        </span> 
                    </div>
                </div>
                <form>
                    <table class="table table-hover table-responsive" id="tablaTransferencias">
                        <thead>
                        <th></th>
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
                <div class="form-inline text-right">
                    <param class="myCodigo" value="inicial">
                    <label>Total :</label><input type="text" id="costoTotal" class="form-control text-right" style="width: 20%" disabled="true" value="0"/>
                </div>
                <div class="form-group">
                    <input type="button" class="btn btn-cprimary" id="mandarPedido" value="Aceptar"/>
                    <input type="button" class="btn btn-default" id="CancelarPedido" value="Cancelar"/>
                </div>
            </section>
            <h2><span class="glyphicon glyphicon-bullhorn"/>&numsp;Autorización de transferencias</h2>
            <section style="width: 100%">
                <div id="consultapedidos">
                </div>
            </section>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="mdlDetalleTransferencia" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" style="width: 1000px">
                <div class="modal-content">
                    <div class="modal-header">

                        <h4 class="modal-title" id="labelTitulo">Transferencias</h4>
                    </div>
                    <form>
                        <div class="modal-body">
                            <div class="form-group">
                                <div id="mostrartransferencias">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input id="mandarRespuesta" type="button" class="btn btn-cprimary" value="Aceptar Pedido"/>
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
                    <button type='button' class='btn btn-cprimary' id='btnver' onclick='listarProductos()'>Agregar productos seleccionados a la lista</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <script src="../administracion/administracion.js/controlWizard.js"></script>
    <script src="administracion.js/Transferencias.js"></script>
    <script src="administracion.js/requisiciones.js"></script>
</body>
</html>