<?php ?>
<!DOCTYPE html>
<html lang="es">
    <body>
        <div id="wizard">
            <h2><span class="glyphicon glyphicon-th-list"/>&numsp;Tabla de productos agranel</h2>
            <section>
                <div id="null" style="margin: 0% 25% 0% 25%">
                </div>
            </section>
            <h2><span class="glyphicon glyphicon-plus"/>&numsp;Nuevo producto agranel</h2>
            <section>
                <form style="margin: 0% 25% 0% 25%">
                    <div class="form-group">
                        <label>Nombre de la marca:</label>
                        <input type="text" class="form-control" id="txtnombremarca" placeholder="Ingrese el nombre de la nueva marca">
                    </div>
                    <hr>
                    <input id="null" type="button" class="btn btn-primary" data-dismiss="modal" value="Guardar"/>
                </form>
            </section>
        </div>
        <script src="../administracion/administracion.js/controlWizard.js"></script>
        <script src="../administracion/administracion.js/agranel.js"></script>
    </body>
</html>