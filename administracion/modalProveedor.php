<!DOCTYPE html>
<html lang="es">
    <body>
        <!-- Modal -->
        <div class="modal fade" id="mdlProveedor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Nuevo Proveedor</h4>
                    </div>
                    <form>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Nombre:</label>
                                <input type="text" class="form-control" id="txtnombreproveedor" placeholder="Ingrese el nombre del proveedor">
                            </div>
                            <div class="form-group">
                                <label>Direccion:</label>
                                <button id="muestramdldireccion" class="btn btn-default" data-dismiss="modal" type="button" data-toggle="modal" data-target="#mdlDireccion">Nueva direccion</button>
                            </div>
                            <div class="form-group">
                                <label>RFC:</label>
                                <input type="text" class="form-control" id="txtrfc" placeholder="Ingrese el RFC del proveedor">
                            </div>
                            <div class="form-group">
                                <label>Dias de credito:</label>
                                <input id="txtdiascredito" type="number" class="form-control"  placeholder="Ingrese los dias de credito">
                            </div>
                            <div class="form-group">
                                <label>Descuento:</label>
                                <input id="txtdescuento" type="number" class="form-control"  placeholder="Ingrese el descuento">
                            </div>
                            <div class="modal-footer">
                                <input id="btncanceloProvedor" type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar"/>
                                <input id="btnguardarproveedor" type="button" class="btn btn-cprimary"  data-dismiss="modal" value="Guardar"/>
                            </div>
                        </div>
                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <!-- JSCRIPT -->
<!--        <script src="administracion.js/modalProveedor.js"></script>-->
    </body>
</html>


