<?php ?>
<!DOCTYPE html>
<html lang="es">
    <body>
        <div id="wizard">
            <h2><span class="glyphicon glyphicon-list-alt" />&numsp;Consulta Orden Compra</h2>
            <section>
                <div id="tablaOrden">
                    
                </div>
<!--                <table  class="table table-hover table-responsive" id="tablaOrden">
                </table>-->
            </section>
            <h2><span class="glyphicon glyphicon-file"/>&numsp;Orden de compra / Cotizaciones</h2>
            <section>
                <div class="form-group">
                    <label class="radio-inline" >
                        <span>
                            <input type="radio" name="tipo" id="cotizar" value="cotizar" onclick="seleccionTipo();" />
                            Cotizar
                        </span>
                    </label>
                    <label class="radio-inline" >
                        <span>
                            <input type="radio" name="tipo" id="orden" onclick="seleccionTipo();" value="orden" checked/>
                            Orden Compra
                        </span>
                    </label>
                </div>
                <div class="form-group form-inline" >
                    <label id="folio">Folio: </label>
                    <input id="folioM" type="number" class="form-control"  placeholder="Folio">&numsp;   
                    <label id="lblproveedor">Proveedor: </label>
                    <select id="proveedores" class="selectpicker" data-container="body" data-live-search="true" data-style="btn-default"></select>&numsp;
                    <label id="lblemailP">Email: </label>
                    <select id="emailProveedor" class="selectpicker" data-container="body" data-live-search="true" data-style="btn-default"></select>&numsp;
                    <label id="lblemailO">Otro email(opcional): </label>
                    <input id="txtEmail" class="form-control"/>                       
                    <param class="CProducto" hidden="true" value="nada">
                </div>
                <hr>
                <div class="form-group">
                    <div class="input-group" style="width: 30%" id="panelBusqueda">
                        <input type="text" class="form-control" id="codigoProductoEntradas"  placeholder="Codigo" disabled="true"/>
                        <span class="input-group-btn">
                            <button type="button"  class="btn btn-cprimary" value="Busqueda Rapida" id="btnbuscador"><span class="glyphicon glyphicon-search"></span> Buscar productos</button>
                        </span> 
                    </div>
                </div>
                <hr>
                <div class="form-group form-inline">
                    <div class="checkbox-inline">
                        <span>
                            <input type="checkbox" id="descuentosGlobalesManuales"> Desct. por producto
                        </span>
                    </div>
                    <div class="checkbox-inline">
                        <span>
                            <input type="checkbox" id="descuentosGeneralesM"> Desct. Generales: 
                        </span>
                    </div>
                    <input type="text" disabled="true" id="descuentosGeneralesPorComasM" onkeyup="generarDescuentosgenerales()" class="form-control input-sm" />
                </div>
                <form>
                    <table class="table table-hover" id="tablaDatosEntrada">
                        <thead>
                        <th>Eliminar </th>
                        <th>Cantidad</th>
                        <th>Codigo</th>
                        <th>Descripcion</th>
                        <th>Costo Anterior</th>
                        <th>Costo</th>
                        <th>Desct. 1</th>
                        <th>Desct. 2</th>
                        <th>Desct. Total</th>
                        <th>CDA</th>
                        <th>Importe</th> 
                        </thead>
                    </table>
                </form>
                <hr>
                <form class="form-inline text-right">
                    <span>Subtotal : <input type="text" id="subTotalM" class="form-control text-right resultando" style="width: 20%" disabled="true"/></span>
                </form>
                <br>
                <form class="form-inline text-right">
                    <span>Desc. General : <input type="text" id="descuentoGeneralM" class="form-control text-right resultando" style="width: 20%" disabled="true"/></span>
                    <span>Desc. Productos : <input type="text" id="descuentoProductosM" class="form-control text-right resultando" style="width: 20%" disabled="true"/></span>
                    <span>Desc. Total : <input type="text" id="descuentoTotalM" class="form-control text-right resultando" style="width: 20%" disabled="true"/></span>
                </form>
                <br>
                <form class="form-inline text-right">
                    <span>SDA : <input type="text" id="sdaM" class="form-control text-right resultando" style="width: 20%" disabled="true"/></span>
                </form>
                <br>
                <form class="form-inline text-right">
                    <span>Iva 16% : <input type="text" id="ivaM" class="form-control text-right resultando" style="width: 20%" disabled="true"/></span>
                </form>
                <br>
                <form class="form-inline text-right">
                    <span>Total : <input type="text" id="costoTotal" class="form-control text-right resultando" style="width: 20%" disabled="true"/></span>
                </form>
                <br>
                <input type="button" class="btn btn-cprimary" value="Guardar Cotizacion" id="guardarOrdenCompra"/>
                <input type="button" class="btn btn-cprimary" value="Enviar Orden de Compra" id="enviarOrdenCompra"/>
                <input type="button" class="btn btn-cprimary" value="Modificar Orden" id="ModificarOrden"/>
                <input type="button" class="btn btn-default" value="Limpiar Orden" id="CancelarOrden"/>
                <input type="button" class="btn btn-cprimary" value="Guardar y Enviar Orden" id="guardaEnviaOrden"/>
            </section>

<!--            <h2><span class="glyphicon glyphicon-upload"/>&numsp;nada</h2>
            <section>
                <form id="xmlenrada" style="margin: 0% 25% 0% 25%">
                    <input type="file" id="buscaxmlentrada" name="buscaxmlentrada[]"  accept="application/xml" title="Buscar XML">
                    <hr>
                    <div>
                        <input type="button" id="cargar" class="btn btn-primary " value="Cargar archivo" onclick="comprueba_extension_xmlentrada(this.form, this.form.buscaxmlentrada.value)">
                    </div>
                </form>
                <div id="cargaxml">
                     Aqui van los archivos cargados 
                </div>
                <form id="validacionentradas">
                    <input type="button" class="btn btn-default" value="Nuevo XML" id="cancelarentrada"/>
                    <input type="button" class="btn btn-primary" value="Validar" id="validarentrada"/>
                </form>
            </section>-->
        </div>
        <!-- Modal -->
        <!--        <div class="modal fade" id="mdlconsultaid" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="myModalLabel">Buscar ID Producto</h4>
                            </div>
                            <div class="modal-body">
                                <div id="veridproductos">
                                </div>
                            </div>
                        </div> /.modal-content 
                    </div> /.modal-dialog 
                </div> /.modal -->
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
        <script src="../administracion/administracion.js/ordenCompra.js"></script>
        <script src="../utilerias/validCampoFranz.js"></script>
    </body>
</html>
<!--<input type="text" onkeyup="sumaCantidad(1,2,3);"/>-->
