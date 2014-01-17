<?php ?>
<!DOCTYPE html>
<html lang="es">
    <body>
        <div id="wizard">
            <h2><span class="glyphicon glyphicon-th-list"/>&numsp;Tabla de proveedores</h2>
            <section>
                <div id="consultaProveedor">
                </div>
            </section>
            <h2><span class="glyphicon glyphicon-plus"/>&numsp;Nuevo proveedor</h2>
            <section>
                <form style="margin: 0% 25% 0% 25%">
                    <div class="form-group">
                        <label>Nombre:</label>
                        <input type="text" class="form-control" id="txtnombreproveedor" placeholder="Ingrese el nombre del proveedor">
                    </div>
                    <div class="form-group">
                        <label>Direccion:</label>
                        <input id="muestramdldireccion" class="btn btn-sm btn-default" data-dismiss="modal" type="button" data-toggle="modal" data-target="#mdlDireccion" value="+"/>
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
                        <!--<input id="btncanceloProvedor" type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar"/>-->
                        <input id="btnguardarproveedor" type="button" class="btn btn-primary"  data-dismiss="modal" value="Guardar"/>
                    </div>
                </form>
            </section>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="mdlDireccion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                <input id="canceloDireccion" type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar"/>
                                <input id="btnguardardireccion" type="button" class="btn btn-primary"  data-dismiss="modal" value="Guardar"/>
                            </div>
                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <script src="../administracion/administracion.js/controlWizard.js"></script>
        <script src="../utilerias/validCampoFranz.js"></script>
        <script src="../administracion/administracion.js/proveedor.js"></script>
        <script src="../administracion/administracion.js/direccion.js"></script>
    </body>
</html>