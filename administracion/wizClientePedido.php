<?php ?>
<!DOCTYPE html>
<html lang="es">
    <body>
        <div id="wizard">
            <h2><span class="glyphicon glyphicon-list-alt" />&numsp;Tabla ordenes de clientes</h2>
            <section>
                <div id="tablaOrden">
                </div>
            </section>

            <h2><span class="glyphicon glyphicon-barcode"/>&numsp;Orden de compra para clientes</h2>
            <section>

                <div class="form-group">
                    <label class="radio-inline" >
                        <span>
                            <input type="radio" name="tipo" id="cotizar" value="cotizar" onclick="seleccionTipo();" />
                            Nuevo Pedido
                        </span>
                    </label>
                    <label class="radio-inline" >
                        <span>
                            <input type="radio" name="tipo" id="orden" onclick="seleccionTipo();" value="orden" checked/>
                            Revisar/Modificar Pedido                        </span>
                    </label>
                </div>
                <div class="form-group">
                    <select id="sucursal" class="form-control" style="width: 50%">
                        <option value="0">Seleccione una Sucursal</option>
                    </select>
                </div>
                <div class="form-group form-inline" >
                    <label id="folio">Folio: </label>
                    <input id="folioM" type="number" class="form-control"/>  
                </div>
                <hr>
                <div class="form-group">
                    <div class="input-group" id="panelBusqueda" style="width: 30%">
                        <input type="text" class="form-control" id="codigoProductoEntradas" placeholder="Codigo" />
                        <span class="input-group-btn">
                            <input type="button"  class="btn btn-cprimary" value="Busqueda Rapida" id="btnbuscador"/>

                        </span> 
                    </div>
                </div>
                <hr>
                <div>
                    <table class="table table-hover" id="tablaDatosEntrada">
                        <thead> 
                        <th >Eliminar</th>
                        <th>Cantidad</th>
                        <th>Codigo</th>
                        <th>Descripcion</th>
                        <th>Costo</th>
                        <th>Existencia</th>
    <!--                    <th>Desct. 1</th>
                        <th>Desct. 2</th>-->
    <!--                    <th>Desct. Total</th>-->
    <!--                    <th>CDA</th>-->
                        <th>Importe</th> 
                        </thead>
                    </table>
                </div>
                <hr>
                <form class="form-inline text-right">
                    <span>Subtotal : <input type="text" id="subTotalM" class="form-control text-right resultando" style="width: 20%" disabled="true" value="0"/></span>
                </form>

                <form class="form-inline text-right">
                    <!--<span>SDA :--> 
                    <input type="hidden" id="sdaM" class="form-control text-right resultando" style="width: 20%" disabled="true" value="0"/></span>
                </form>
                <br>
                <form class="form-inline text-right">
                    <span>Iva 16% : <input type="text" id="ivaM" class="form-control text-right resultando" style="width: 20%" disabled="true" value="0"/></span>
                </form>
                <br>
                <form class="form-inline text-right">
                    <span>Total : <input type="text" id="costoTotal" class="form-control text-right resultando" style="width: 20%" disabled="true" value="0"/></span>
                </form>
                <br>
                <input type="button" class="btn btn-cprimary" value="Guardar Cotizacion" id="guardarOrdenCompra"/>
                <input type="button" class="btn btn-cprimary" value="Guardar Cambios Compra" id="enviarOrdenCompra"/>
                <input type="button" class="btn btn-cprimary" value="Modificar Orden" id="ModificarOrden"/>
                <input type="button" class="btn btn-default" value="Limpiar Orden" id="CancelarOrden"/>
                <input type="button" class="btn btn-cprimary" value="Guardar y Enviar Orden" id="guardaEnviaOrden"/>
            </section>
        </div>
        <!-- Modal -->
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
        <script src="../administracion/administracion.js/XmlComprobante.js"></script>
        <script src="../administracion/administracion.js/XmlConceptos.js"></script>
        <script src="../administracion/administracion.js/controlWizard.js"></script>
        <script src="../administracion/administracion.js/entradas.js"></script>
        <script src="../administracion/administracion.js/xmlEntradas.js"></script>
        <script src="../administracion/administracion.js/xmlCalculosOrdenes.js"></script>
        <script src="../administracion/administracion.js/pedidoCliente.js"></script>
        <script src="../utilerias/validCampoFranz.js"></script>
        <!--<script src="../administracion/administracion.js/buscador.js"></script>-->
    </body>
</html>
<!--<input type="text" onkeyup="sumaCantidad(1,2,3);"/>-->
