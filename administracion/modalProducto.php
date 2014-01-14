<!DOCTYPE html>
<html lang="es">
    <body>
        <!-- Modal -->
        <div class="modal fade" id="mdlProducto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Nuevo Producto</h4>
                    </div>
                    <form id="cuerpo">
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Nombre:</label>
                                <input type="text" class="form-control" id="txtNombreProducto" placeholder="Nombre del producto" required>
                            </div>
                            <div class="form-group">
                                <label>Marca:</label><br>
                                <select id="selectMarca" style="width: 50%; height: 35px">
                                </select>
                                <input href="#mdlMarca" data-toggle="modal" data-dismiss="modal" type="button" class="btn btn-primary" value="+">
                            </div>
                            <div class="form-group">
                                <label>Proveedor:</label><br>
                                <select id="selectProveedor" style="width: 50%; height: 35px">
                                </select>
                                <input href="#mdlProveedor" data-toggle="modal" data-dismiss="modal" type="button" class="btn btn-primary" value="+">
                            </div>
                            <div class="form-group">
                                <label>Lista de Precios:</label><br>
                                <select id="selectListaPrecios" style="width: 50%; height: 35px">
                                </select>
                                <input href="#mdlListaPrecios" data-toggle="modal" type="button" class="btn btn-primary" value="+">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar"/>
                            <input type="submit" class="btn btn-primary" value="Guardar" id="guardarDatos"/>
                        </div>
                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <!-- JSCRIPT -->
        <!--<script type="text/javascript" src="administracion.js/modalProducto.js"></script>-->
    </body>
</html>