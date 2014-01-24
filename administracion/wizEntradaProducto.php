<?php ?>
<!DOCTYPE html>
<html lang="es">
    <body>
        <div id="wizard">
            <h2><span class="glyphicon glyphicon-th-list"/>&numsp;Tabla de Inventarios</h2>
            <section>
                <div class="col-lg-3" style="margin-left: 3%">
                    <label>Codigo del Producto</label>
                    <input class="form-control" 
                           type="text" 
                           placeholder="Codigo del producto..."
                           id="codigoProducto"/>
                    <br>
                </div> 
                <br>
                <div class="col-lg-12" style="margin-left: 3%">
                    <div id="detalle" class="well well-lg">
                        Información del producto
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