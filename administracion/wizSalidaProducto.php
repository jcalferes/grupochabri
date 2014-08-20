<?php ?>
<!DOCTYPE html>
<html lang="es">
    <body>
        <div id="wizard">
            <h2><span class="glyphicon glyphicon-th-list"/>&numsp;Tabla de salidas</h2>
            <section style="width: 100%">
                <div id="consultaListaPrecio">
                </div>
            </section>
            <h2><span class="glyphicon glyphicon-upload"/>&numsp;Subir XML</h2>
            <section class="scrollSection">
                <!--==============================-->
                <form id="xml" style="margin: 0% 25% 0% 25%">
                    <input type="file" id="buscaxml" name="buscaxml[]"  accept="application/xml" title="Buscar XML">
                    <hr>
                    <div id="uno">
                        <input type="button" id="cargar" class="btn btn-cprimary " value="Cargar archivo" onclick="comprueba_extension(this.form, this.form.buscaxml.value)">
                    </div>
                </form>
                <div id="cargados">
                    <!-- Aqui van los archivos cargados -->
                </div>
                <form id="validacion">
                    <input type="button" class="btn btn-default" value="Nuevo XML" id="cancelar"/>
                    <input type="button" class="btn btn-cprimary" value="Validar" id="validar"/>
                </form>
                <!--==============================-->
            </section>
        </div>
        <script src="../administracion/administracion.js/controlWizard.js"></script>
        <script src="administracion.js/xmlSalidas.js"></script>
    </body>
</html>