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
                            <label  class="col-sm-2 control-label">Codigo Producto</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" id="codigoProducto" placeholder="Codigo">
                            </div>
                        </div>
                        <div id="datosCaptura">
                            <div class="form-group">
                                <label for="cantidadMinima" class="col-sm-2 control-label">Cantidad Minima</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="cantidadMinima" placeholder="Cantidad Minima">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="cantidadMaxima" class="col-sm-2 control-label">Cantidad Maxima</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="cantidadMaxima" placeholder="Cantidad Minima">
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
