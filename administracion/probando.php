<?php ?>
<!DOCTYPE html>
<html lang="es">
    <body>



            <form id="xmlenrada" style="margin: 0% 25% 0% 25%">
                <input type="text" id="descripcion" >
            <input type="file" id="files" name="files[]" accept=".jpg" multiple />
            <output id="list"></output>
            <input id="subirImagenes" type="button" value="aceptar"/>
            </form>
            <div id="cargaxml">
                <!-- Aqui van los archivos cargados -->
            </div>


            <!-- Modal -->

            <script src="../bootstrap/js/jquery.js"></script>
            <script src="../bootstrap/js/bootstrap.min.js"></script>
            <script src="../alertify/lib/alertify.min.js"></script>
            <script src="../administracion/administracion.js/clasificados.js"></script>
            <script src="../utilerias/validCampoFranz.js"></script>
            <script src="../alertify/lib/alertify.min.js"></script>

    </body>

</html>
<!--<input type="tex