<?php ?>
<!DOCTYPE html>
<html lang="es">
    <body>
        <div id="wizard">
            <h2><span class="glyphicon glyphicon-list-alt" />&numsp;Tabla de Inventarios</h2>
            <section>
                <div class="form"  style="margin: 0% 25% 0% 25%">
                    <div class="form-group">
                        <label  class="control-label">Codigo:</label>
                        <div class="input-group">
                            <input  type="text" class="form-control" id="codigoProducto" placeholder="Codigo"/>
                            <span class="input-group-btn">
                                <button  id="buscarCodigo" class="btn btn-default" type="button" title="Buscar">
                                    <span class="glyphicon glyphicon-search"></span>
                                </button>
                            </span> 
                        </div>
                    </div>
                    <div class="form-group">
                        <input id="guardarEntradas" type="submit" class=" btn btn-cprimary" value="Guardar"/>
                        <input  id="cancelarEntradas" type="submit" class="btn btn-default" value="Cancelar"/>
                    </div>
                    <div id="datosCaptura">
                        <div class="form-group">
                            <label  class="control-label">Cantidad</label>
                            <input type="text" class="form-control" id="cantidad" placeholder="Cantidad"/>
                        </div>
                    </div>
                </div>
                <div id="detalle">
                </div>
                <table  class="table table-hover" id="tablaEntradas">
                </table>
            </section>

            <h2><span class="glyphicon glyphicon-barcode"/>&numsp;Entradas Manuales</h2>
            <section>
                <form class="form-horizontal" role="form">
                    <div class="form-group form-inline" >
                        <label>Proveedor: </label>
                        <select id="proveedores" class="selectpicker" data-container="body" data-live-search="true" data-style="btn-default"></select>&numsp;
                        <label>Folio: </label>
                        <input id="folioM" type="text" class="form-control"  placeholder="Folio">&numsp;
                        <label>Fecha Emitida: </label>
                        <input id="fechaEmitidaM" type="date" class="form-control" />
                    </div>
                    <div class="form-group form-inline">

                        <div class="checkbox">
                            <label>
                                <input type="checkbox" id="descuentosGlobalesManuales"> Desct. por producto
                            </label>
                        </div><br>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" id="descuentosGeneralesM"> Desct. Generales: 
                            </label>
                        </div>
                        <input type="text" disabled="true" id="descuentosGeneralesPorComasM" onkeyup="generarDescuentosgenerales()" class="form-control input-sm"/>
                    </div>
                    <div class="form-group form-inline">
                        <div class="input-group" id="panelBusqueda">
                            <input type="text" class="form-control" id="codigoProductoEntradas" placeholder="Codigo" disabled="true"/>
                            <span class="input-group-btn">
                                <button  id="buscarCodigoEntradas" class="btn btn-default" type="button" title="Buscar" disabled="true">
                                    <span class="glyphicon glyphicon-search"></span>
                                </button>
                            </span> 
                        </div>
                    </div>
                </form>
                <table class="table table-hover" id="tablaDatosEntrada">
                    <thead>
                    <th>Cantidad</th>
                    <th>Codigo</th>
                    <th>Descripcion</th>
                    <th>Ult.Costo</th>
                    <th>Costo</th>
                    <th>Desct. 1</th>
                    <th>Desct. 2</th>
                    <th>Desct. Total</th>
                    <th>CDA</th>
                    <th>Importe</th> 
                    </thead>
                </table>
                <hr>
                <form class="form-inline text-right">
                    <span>Subtotal : <input type="text" id="subTotalM" class="form-control text-right" style="width: 20%" disabled="true"/></span>
                </form>
                <br>
                <form class="form-inline text-right">
                    <span>Desc. General : <input type="text" id="descuentoGeneralM" class="form-control text-right" style="width: 20%" disabled="true"/></span>
                    <span>Desc. Productos : <input type="text" id="descuentoProductosM" class="form-control text-right" style="width: 20%" disabled="true"/></span>
                    <span>Desc. Total : <input type="text" id="descuentoTotalM" class="form-control text-right" style="width: 20%" disabled="true"/></span>
                </form>
                <br>
                <form class="form-inline text-right">
                    <span>SDA : <input type="text" id="sdaM" class="form-control text-right" style="width: 20%" disabled="true"/></span>
                </form>
                <br>
                <form class="form-inline text-right">
                    <span>Iva 16% : <input type="text" id="ivaM" class="form-control text-right" style="width: 20%" disabled="true"/></span>
                </form>
                <br>
                <form class="form-inline text-right">
                    <span>Total : <input type="text" id="costoTotal" class="form-control text-right" style="width: 20%" disabled="true"/></span>
                </form>
                <br>
                <input type="button" class="btn btn-cprimary" value="Guardar" id="guardarEntradasManualmente"/>
            </section>
            
            <h2><span class="glyphicon glyphicon-upload"/>&numsp;Entradas por XML</h2>
            <section>
                <form id="xmlenrada" style="margin: 0% 25% 0% 25%">
                    <input type="file" id="buscaxmlentrada" name="buscaxmlentrada[]"  accept="application/xml" title="Buscar XML">
                    <hr>
                    <div>
                        <input type="button" id="cargar" class="btn btn-cprimary " value="Cargar archivo"  onclick="comprueba_extension_xmlentrada(this.form, this.form.buscaxmlentrada.value)">
                    </div>
                </form>
                <div id="cargaxml">
                    <!-- Aqui van los archivos cargados -->
                </div>
                <form id="validacionentradas">
                    <input type="button" class="btn btn-default" value="Nuevo XML" id="cancelarentrada"/>
                    <input type="button" class="btn btn-cprimary" value="Validar" id="validarentrada"/>
                </form>
            </section>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="mdlconsultaid" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <script src="../administracion/administracion.js/XmlComprobante.js"></script>
        <script src="../administracion/administracion.js/XmlConceptos.js"></script>
        <script src="../administracion/administracion.js/controlWizard.js"></script>
        <script src="../administracion/administracion.js/entradas.js"></script>
        <script src="../administracion/administracion.js/xmlEntradas.js"></script>
        <script src="../administracion/administracion.js/xmlCalculos.js"></script>
        <script src="../administracion/administracion.js/entradasManualmente.js"></script>
        <script src="../utilerias/validCampoFranz.js"></script>
    </body>
</html>
<!--<input type="text" onkeyup="sumaCantidad(1,2,3);"/>-->
