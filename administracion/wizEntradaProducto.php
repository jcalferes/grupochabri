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
            <h2><span class="glyphicon glyphicon-th-list"/>&numsp;Transferencias</h2>
            <section>

            </section>
        </div>
        <script src="../administracion/administracion.js/controlWizard.js"></script>
        <script src="../administracion/administracion.js/entradas.js"></script>
    </body>
</html>
