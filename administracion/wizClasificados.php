<?php ?>
<!DOCTYPE html>
<html lang="es">
    <body>
        <div id="wizard">
            <h2><span class="glyphicon glyphicon-list-alt"/>&numsp;Tabla de clasificados</h2>
            <section>
                <div id="consultarProductosPublicados">
                </div>
            </section>
            <h2><span class="glyphicon glyphicon-star"/>&numsp;Publicar nuevo clasificado</h2>
            <section>
                <div style="margin: 0% 25% 0% 25%">
                   
                        <div class="form-group">
                            <label>Codigo del producto:</label>
                            <input type="text" class="form-control" id="clascodigoproducto"/>
                        </div>
                     <form id="mostrando">
                        <div class="form-group">
                            <label>Descripcion del producto:</label>
                            <textarea id="descripcion" style="margin: 0px; width: 779px; height: 135px;"></textarea>
                        </div>


                       
<!--                        <div class="form-group">
                            <label>Grupo de producto:</label><br/>
                            <select id="selectGrupo" style="width: 40%; height: 35px" class="selectpicker selectores" data-container="body" data-live-search="true">
                            </select>
                        </div> -->
                        <div class="form-group" id="productosTipos">
                            <label>Tipo de producto:</label><br/>
                            <select id="selectTipo" style="width: 40%; height: 35px" class="selectpicker selectores" data-container="body" data-live-search="true"><input type="button" class="btn btn-cprimary" data-dismiss="modal" data-toggle="modal" data-target="#mdlTipoProducto" value="+"/>
                            </select>
                        </div> 
                         <div class="form-group">
                            <label>Subir Maximo 5 imagenes:</label>
                            <input type="file" id="files" name="files[]" accept=".jpg" multiple />
                            <output id="list"></output>

                        </div>
                         <div class="form-group">
                            <label>Poner Recomendado:</label>
                            <input type="checkbox" id="recomendado">

                        </div>
                        <div class="form-group">
                            <label>Poner Novedades:</label>
                             <input type="checkbox" id="Novedades">

                        </div>
                        <input id="subirImagenes" type="button" value="aceptar" class="btn btn-primary"/>
                          <input id="Limpiar" type="button" value="limpiar" class="btn btn-primary"/>
                    </form>
                </div>
            </section>
            <h2><span class="glyphicon glyphicon-picture"/>&numsp;Publicar en slider</h2>
            <section>
                <div style="margin: 0% 25% 0% 25%">
                </div>
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
        <script src="../administracion/administracion.js/controlWizard.js"></script>
        <script src="../administracion/administracion.js/clasificados.js"></script>

    </body>
</html>