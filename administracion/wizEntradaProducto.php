<?php ?>
<!DOCTYPE html>
<html lang="es">
    <body>
        <div id="wizard">
            <h2><span class="glyphicon glyphicon-th-list"/>&numsp;Tabla de Entradas</h2>
            <section class="scrollSection">
                <div class="col-lg-3" style="margin-left: 3%">
                    <label>Codigo del Producto</label>
                    <input class="form-control" 
                           type="text" 
                           placeholder="Codigo del producto..."
                           id="codigoProducto"/>
                </div>
                <br>
                <br>
                <div style="margin-left: 5%">
                    <table  class="table table-hover"
                            id="tablaEntradas">

                    </table>
                </div>
            </section>
        </div>
        <script src="../administracion/administracion.js/controlWizard.js"></script>
        <script src="../administracion/administracion.js/entradas.js"></script>
    </body>
</html>