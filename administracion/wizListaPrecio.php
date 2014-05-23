<?php ?>
<!DOCTYPE html>
<html lang="es">
    <body>
        <div id="wizard">
            <h2><span class="glyphicon glyphicon-th-list" />&numsp;Tabla de Listas</h2>
            <section>
                <div id="consultaListaPrecio" style="margin: 0% 25% 0% 25%">
                </div>
            </section>
            <h2><span class="glyphicon glyphicon-plus"/>&numsp;Nueva lista</h2>
            <section class="scrollSection">
                <form style="margin: 0% 25% 0% 25%">
                    <div class="form-group">
                        <label>Nombre de lista de precios:</label>
                        <input type="text" class="form-control" id="txtnombrelista" placeholder="Ingrese el nombre de la nueva lista de precios">
                    </div>
                    <hr>
                    <input id="btnguardarLista" type="button" class="btn btn-primary" value="Guardar"/>
                </form>
            </section>
        </div>
        <script src="../administracion/administracion.js/controlWizard.js"></script>
        <script src="administracion.js/listaPrecios.js"></script>
    </body>
</html>