<?php ?>
<!DOCTYPE html>
<html lang="es">
    <body>
        <div id="wizard">
            <h2><span class="glyphicon glyphicon-th-list"/>&numsp;Precio Venta Producto</h2>
            <section class="scrollSection">
                <div id="consultaTarifas" style="margin-left: 5%">
<!--                    <select id="selectTarifa" style="width: 90%; height: 35px">
                    </select>-->
                    <div id="tablaTarifas" style="margin-left: 5%">
                    </div>
                </div>
            </section>
            <h2><span class="glyphicon glyphicon-plus"/>&numsp;Agregar Precio Venta</h2>
            <section class="scrollSection">
                <form style="margin: 0% 25% 0% 25%">
                    <div id="consultaTarifas" style="margin-left: 5%">
                        <select id="selectTarifa" style="width: 90%; height: 35px">
                        </select>
                        <div id="tablaTarifas" style="margin-left: 5%">

                        </div>
                        <input id="muestramdldireccion" class="btn btn-sm btn-default" data-dismiss="modal" type="button" data-toggle="modal" data-target="#mdlTarifas" value="+"/>
                </form>
            </section>
        </div>
        <div class="modal fade" id="mdlTarifas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Precios Venta</h4>
                        <param id="idProducto"> 
                        <param id="nombreProducto">
                    </div>
                    <form>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Lista de Precio:</label>
                                <select id="mostrarTarifas" style="width: 90%; height: 35px">
                                </select>
                            </div>
                            <!--                        <div class="modal-body">
                                                        <div class="form-group">
                                                            <label>Costo:</label>
                                                            <input type="text" class="form-control" id="txtCosto" placeholder="Ingrese el costo">
                                                        </div>
                                                    </div>-->
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Tarifa:</label>
                                    <input type="text" class="form-control" id="txtTarifa" placeholder="Ingrese la tarifa">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input id="canceloTarifa" type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar"/>
                                <input id="btnguardarTarifa" type="button" class="btn btn-primary" data-dismiss="modal" value="Guardar" />
                            </div>
                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <script src="../utilerias/validCampoFranz.js"></script>
        <script src="../administracion/administracion.js/controlWizard.js"></script>
        <script src="../utilerias/validCampoFranz.js"></script>   
        <script src="../administracion/administracion.js/tarifas.js"></script>
    </body>
</html>
