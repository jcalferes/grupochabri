<?php ?>
<!DOCTYPE html>
<html lang="es">
    <body>
        <div id="wizard">
            <h2><span class="glyphicon glyphicon-list-alt"/>&numsp;Tabla de marcas</h2>
            <section>
                <div id="consultaMarca" style="margin: 0% 25% 0% 25%">
                </div>
            </section>
            <h2><span class="glyphicon glyphicon-plus"/>&numsp;Nueva marca</h2>
            <section>
                <form style="margin: 0% 25% 0% 25%">
                    <div class="form-group">
                        <label>Nombre de la marca:</label>
                        <input type="text" class="form-control" id="txtnombremarca">
                    </div>
                    <!--<input id="canceloMarca" type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar"/>-->
                    <input id="btnguardarMarca" type="button" class="btn btn-cprimary" data-dismiss="modal" value="Guardar"/>
                </form>
            </section>
        </div>
        <script src="../administracion/administracion.js/controlWizard.js"></script>
        <script src="../administracion/administracion.js/marca.js"></script>
    </body>
</html>