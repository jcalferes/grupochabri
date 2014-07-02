<?php ?>
<!DOCTYPE html>
<html lang="es">
    <body>
        <div id="wizard">



            <form id="xmlenrada" style="margin: 0% 25% 0% 25%">
                <input type="text" id="Descripcion">
                 <input type="text" id="tipoProducto">
           <input type="file" id="files" name="files[]" accept=".jpg" multiple />
            <output id="list"></output>
            <button id="subirImagenes">Aceptar</button>
            </form>
            <div id="cargaxml">
                <!-- Aqui van los archivos cargados -->
            </div>


            <!-- Modal -->

            <script src="../bootstrap/js/jquery.js"></script>
            <script src="../bootstrap/js/bootstrap.min.js"></script>
            <script src="../index/index.js/respond.min.js"></script>
            <script src="../index/index.js/jquery.slides.min.js"></script>
            <script src="../alertify/lib/alertify.min.js"></script>
            <script src="../administracion/administracion.js/clasificados.js"></script>
            <script src="../utilerias/validCampoFranz.js"></script>
            <script src="../alertify/lib/alertify.min.js"></script>

    </body>

</html>
<!--<input type="tex