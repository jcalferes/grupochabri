<!DOCTYPE html>
<html lang="es">
    <body>
        <!-- Modal -->
        <div class="modal fade" id="mdlDireccion" tabindex="-1" data-focus-on="input:first" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Nueva Direccion</h4>
                    </div>
                    <form>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Calle:</label>
                                <input type="text" class="form-control" id="txtcalle" placeholder="Ingrese el numero de calle">
                            </div>
                            <div class="form-group">
                                <label>Numero Exterior:</label>
                                <input type="text" class="form-control" id="txtnumeroexterior" placeholder="Ingrese el numero exterior">
                            </div>
                            <div class="form-group">
                                <label>Numero Interior:</label>
                                <input type="text" class="form-control" id="txtnumerointerior" placeholder="Ingrese el numero interior">
                            </div>
                            <div class="form-group">
                                <label>Codigo Postal:</label>
                                <input id="txtpostal" type="number" class="form-control"  placeholder="Ingrese el codigo postal">
                            </div>
                            <div class="form-group">
                                <label>Colonia:</label>
                                <input id="txtcolonia" type="text" class="form-control"  placeholder="Ingrese la colonia">
                            </div>
                            <div class="modal-footer">
                                <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar"/>
                                <input id="btnguardar" type="button" class="btn btn-primary" value="Guardar"/>
                            </div>
                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <!-- JSCRIPT -->
        <script src="../utilerias/validCampoFranz.js"></script>
        <script src="administracion.js/modalDireccion.js"></script>
    </body>
</html>

