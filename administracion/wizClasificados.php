<?php ?>
<!DOCTYPE html>
<html lang="es">
    <body>
        <div id="wizard">
            <h2><span class="glyphicon glyphicon-list-alt"/>&numsp;Tabla de clasificados</h2>
            <section>
                <div id="consultarProductosPublicados">
                </div>
                <input type="button" class="btn btn-cprimary" data-dismiss="modal" data-toggle="modal" data-target="#mdlDetalleImagenes" value="+" id="botonninja"/>

            </section>
            <h2><span class="glyphicon glyphicon-star"/>&numsp;Publicar nuevo clasificado</h2>
            <section>
                <div style="margin: 0% 25% 0% 25%">

                    <div class="form-group">
                        <label>Codigo del producto:</label>
                        <input type="text" class="form-control" id="clascodigoproducto" style="width: 50%" />
                    </div>
                    <form id="mostrando">
                        <div class="form-group" hidden>
                            <label>Nombre Producto:</label>
                            <input type="text" class="form-control" id="producto" disabled/>
                        </div>

                        <div class="form-group">
                            <label>Descripcion del producto:</label>
                            <textarea class="form-control" id="descripcion" style="margin: 0px; width: 579px; height: 135px;"></textarea>
                        </div>                        
                        <div class="form-group" hidden>
                            <label>Grupo Producto:</label>
                            <input type="text" class="form-control" id="grupo" disabled/>
                        </div>
                        <div class="form-group form-inline" id="productosTipos">
                            <label>Tipo de producto:</label><br/>
                            <select id="selectTipo" style="width: 40%; height: 35px" class="selectpicker selectores" data-container="body" data-live-search="true">
                            </select>
                            <input type="button" class="btn btn-cprimary" data-dismiss="modal" data-toggle="modal" data-target="#mdlTipoProducto" value="+"/>
                        </div> 
                        <div class="form-group" id="mostrarImagenes">
                            <div class="row selected-classifieds">
                                <div class="col-sm-6 col-md-2 conte" id="contenedor1" hidden="true">
                                    <div class="thumbnail contenedorImagenes" id="imagen1" >

                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-2 conte" id="contenedor2" hidden="true">
                                    <div class="thumbnail contenedorImagenes" id="imagen2" >

                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-2 conte" id="contenedor3" hidden="true">
                                    <div class="thumbnail contenedorImagenes" id="imagen3" >

                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-2 conte" id="contenedor4" hidden="true">
                                    <div class="thumbnail contenedorImagenes" id="imagen4" >

                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-2 conte" id="contenedor5" hidden="true">
                                    <div class="thumbnail contenedorImagenes" id="imagen5" >

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Imagen(es) del producto</label>
                            <span id="textoValor" class="text-muted"><em>Maximo 5 imagenes</em></span>
                            <input type="file" id="files" name="files[]" accept=".jpg" multiple />
                            <output id="list"></output>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" id="recomendado"> Poner en "Productos recomendados"
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" id="Novedades"> Poner en "Novedades"
                            </label>
                        </div>
                        <hr>
                        <input id="subirImagenes" type="button" value="Aceptar" class="btn btn-cprimary"/>
                        <input id="limpiar" type="button" value="Cancelar" class="btn btn-default"/>
                        <input id="editarImagenes" type="button" value="Editar" class="btn btn-cprimary"/>
                    </form>
                </div>
            </section>
            <h2><span class="glyphicon glyphicon-picture"/>&numsp;Publicar en slider</h2>
            <section>
                <form id="buscaslider" style="margin: 0% 25% 0% 25%">
                    <div class="well well-sm">
                        Imagenes que actualmente estan en el slider
                    </div>
                    <input type="file" id="imgslider" name="imgslider[]"  accept="image/x-png, image/gif, image/jpeg" title="Buscar imagen">
                    <hr>
                    <div>
                        <input type="button" id="cargar" class="btn btn-cprimary " value="Cargar imagen"  onclick="comprueba_extension_imgslider(this.form, this.form.imgslider.value)">
                    </div>
                </form>
            </section>
        </div>
        <div class="modal fade" id="mdlTipoProducto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Nuevo tipo de productos</h4>
                    </div>
                    <form>
                        <div class="modal-body">
                            <div class="form-group">
                                <label> Nombre del tipo de productos:</label>
                                <input type="text" class="form-control" id="txtnombreTipo" >
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input id="cancelGrupo" type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar"/>
                            <input id="btnGuardarTipo" type="button" class="btn btn-cprimary" data-dismiss="modal" value="Guardar" />
                        </div>
                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <div class="modal fade" id="mdlDetalleImagenes" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" style="width: 80%">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="labelTitulo"></h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group" id="mostrarImagenes">
                            <div class="row selected-classifieds">
                                <div class="col-sm-6 col-md-2 conte" id="contenedors1" hidden="true">
                                    <div class="thumbnail contenedorImagenes" id="imagens1" >

                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-2 conte" id="contenedors2" hidden="true">
                                    <div class="thumbnail contenedorImagenes" id="imagens2" >

                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-2 conte" id="contenedors3" hidden="true">
                                    <div class="thumbnail contenedorImagenes" id="imagens3" >

                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-2 conte" id="contenedors4" hidden="true">
                                    <div class="thumbnail contenedorImagenes" id="imagens4" >

                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-2 conte" id="contenedors5" hidden="true">
                                    <div class="thumbnail contenedorImagenes" id="imagens5" >

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <!--<input id="editarTarifas" type="button" class="btn btn-default" value="Editar"/>-->
                            <input id="cancelo" type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar"/>
                            <!--<input id="guardarTarifas" type="button" class="btn btn-primary" data-dismiss="modal" value="Guardar" disabled/>-->
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
            </div>
        </div>
        <script src="../administracion/administracion.js/controlWizard.js"></script>
        <script src="../administracion/administracion.js/clasificados.js"></script>

    </body>
</html>