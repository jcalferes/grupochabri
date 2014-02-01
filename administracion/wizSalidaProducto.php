<?php ?>
<!DOCTYPE html>
<html lang="es">
    <body>
        <div id="wizard">
            <h2><span class="glyphicon glyphicon-th-list"/>&numsp;Tabla de salidas</h2>
            <section class="scrollSection">
                <div id="consultaListaPrecio">
                </div>
            </section>
            <h2><span class="glyphicon glyphicon-upload"/>&numsp;Subir XML</h2>
            <section class="scrollSection">
                <!--==============================-->
                <form name="subexml" action="cargaXMl.php" method="post" enctype="multipart/form-data" style="margin: 0% 25% 0% 25%">
                    <input id="archivo" type="file" name="buscaxml" size="200" accept="application/xml" title="Buscar XML">
                    <hr>
                    <input type=button name="m" value="Enviar" onclick="comprueba_extension(this.form, this.form.buscaxml.value)">
                </form>
                <!--==============================-->
            </section>
        </div>
        <script src="../administracion/administracion.js/controlWizard.js"></script>
        <script src="administracion.js/salidas.js"></script>
    </body>
</html>