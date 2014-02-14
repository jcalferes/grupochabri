<?php ?>
<!DOCTYPE html>
<html lang="es">
    <body>
        <div id="wizard">
            <h2><span class="glyphicon glyphicon-th-list"/>&numsp;Tabla de Inventarios</h2>
            <section>
                <div style="margin-left: 3%">
                    <div class="form-horizontal">
                        <div class="form-group">
                            <label  class="col-sm-2 control-label">Codigo:</label>
                            <div class="col-sm-3">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="codigoProducto" placeholder="Codigo"/>
                                    <span class="input-group-btn">
                                        <button  id="buscarCodigo" class="btn btn-default" type="button" title="Buscar">
                                            <span class="glyphicon glyphicon-search"></span>
                                        </button>
                                    </span> 
                                </div>
                            </div>
                            <input id="guardarEntradas" type="submit" class=" btn btn-primary" value="Guardar"/>
                            <input  id="cancelarEntradas" type="submit" class="btn" value="Cancelar"/>
                        </div>
                        <div id="datosCaptura">
                            <div class="form-group">
                                <label  class="col-sm-2 control-label">Cantidad</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" id="cantidad" placeholder="Cantidad"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12" style="margin-left: 3%">
                    <div id="detalle">
                    </div>
                </div>
                <div style="margin-left: 5%">
                    <table  class="table table-hover"
                            id="tablaEntradas">
                    </table>
                </div>
            </section>
            <h2><span class="glyphicon glyphicon-th-list"/>&numsp;Entradas Proveedores</h2>
            <section>

            </section>
            <h2><span class="glyphicon glyphicon-upload"/>&numsp;Subir XML</h2>
            <section>
                <form id="xmlenrada" style="margin: 0% 25% 0% 25%">
                    <input type="file" id="buscaxmlentrada" name="buscaxmlentrada[]"  accept="application/xml" title="Buscar XML">
                    <hr>
                    <div>
                        <input type="button" id="cargar" class="btn btn-primary " value="Cargar archivo" onclick="comprueba_extension_xmlentrada(this.form, this.form.buscaxmlentrada.value)">
                    </div>
                </form>
                <div id="cargaxml">
                    <!-- Aqui van los archivos cargados -->
                </div>
                <form id="validacionentradas">
                    <input type="button" class="btn btn-default" value="Nuevo XML" id="cancelarentrada"/>
                    <input type="button" class="btn btn-primary" value="Validar" id="validarentrada"/>
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
        <script src="../administracion/administracion.js/controlWizard.js"></script>
        <script src="../administracion/administracion.js/entradas.js"></script>
        <script src="../administracion/administracion.js/xmlEntradas.js"></script>
        <script src="../administracion/administracion.js/xmlCalculos.js"></script>
        <script src="../utilerias/validCampoFranz.js"></script>
    </body>
</html>
