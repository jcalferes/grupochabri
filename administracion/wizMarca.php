<?php ?>
<!DOCTYPE html>
<html lang="es">
    <body>
        <div id="wizard">
            <h2>First Step</h2>
            <section>
            </section>
            <h2>First Step</h2>
            <section>
                <form>
                    <div class="form-group">
                        <label>Nombre de la marca:</label>
                        <input type="text" class="form-control" id="txtnombremarca" placeholder="Ingrese el nombre de la nueva marca">
                    </div>
                    <hr>
                    <input id="canceloMarca" type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar"/>
                    <input id="btnguardarMarca" type="button" class="btn btn-primary" data-dismiss="modal" value="Guardar"/>
                </form>
            </section>
        </div>
        <script src="../administracion/administracion.js/controlWizard.js"></script>
        <script src="../administracion/administracion.js/marca.js"></script>
    </body>
</html>