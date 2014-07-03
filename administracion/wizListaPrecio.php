<?php ?>
<!DOCTYPE html>
<html lang="es">
    <body>
        <div id="wizard">
            <h2><span class="glyphicon glyphicon-list-alt" />&numsp;Tabla de Listas</h2>
            <section>
                <div id="consultaListaPrecio" style="margin: 0% 25% 0% 25%">
                </div>
            </section>
            <h2><span class="glyphicon glyphicon-plus"/>&numsp;Nueva lista de precio</h2>
            <section class="scrollSection">
                <form style="margin: 0% 25% 0% 25%">
                    <div class="form-group">
                        <label>Nombre de la lista de precio:</label>
                        <input type="text" class="form-control" id="txtnombrelista">
                    </div>
                    <input id="btnguardarLista" type="button" class="btn btn-cprimary" value="Guardar"/>
                </form>
            </section>
        </div>
        <script src="../administracion/administracion.js/controlWizard.js"></script>
        <script src="administracion.js/listaPrecios.js"></script>
    </body>
</html>