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
                                <input type="text" class="form-control" id="codigoProducto" placeholder="Codigo">
                            </div>
                            <input id="guardarEntradas" type="submit" class=" btn btn-primary" value="Guardar"/>
                            <input  id="cancelarEntradas" type="submit" class="btn" value="Cancelar"/>
                        </div>
                        <div id="datosCaptura">
                            <div class="form-group">
                                <label  class="col-sm-2 control-label">Cantidad</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" id="cantidad"/>
                                </div>
                                <label  class="col-sm-2 control-label">Cant. Minima</label>
                                <div class="col-sm-2">
                                    <input type="text"  class="form-control" id="cantidadMinima"/>
                                </div>
                                <!--                            </div>
                                                            <div class="form-group">-->
                                <label class="col-sm-2 control-label">Cant. Maxima</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" id="cantidadMaxima"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12" style="margin-left: 3%">
                    <div id="detalle" class="well well-lg">
                    </div>
                </div>
                <br>
                <br>
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
        <script src="../administracion/administracion.js/controlWizard.js"></script>
        <script src="../administracion/administracion.js/entradas.js"></script>
        <script src="../administracion/administracion.js/xmlEntradas.js"></script>
        <script src="../administracion/administracion.js/xmlCalculos.js"></script>
    </body>
</html>
