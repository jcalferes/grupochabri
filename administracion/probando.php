<?php ?>
<!DOCTYPE html>
<html lang="es">
    <body>
        <div id="wizard">
           
            
          
                <form id="xmlenrada" style="margin: 0% 25% 0% 25%">
                    <input type="file" id="buscaxmlentrada" name="buscaxmlentrada[]"  accept=".jpg" title="Buscar XML" multiple="true">
                    <hr>
                    <div>
                        <input type="button" id="cargar" class="btn btn-cprimary " value="Cargar archivo" onclick="comprueba_extension_imagenes(this.form, this.form.buscaxmlentrada.value)">
                    </div>
                </form>
                <div id="cargaxml">
                    <!-- Aqui van los archivos cargados -->
                </div>
               
           
        <!-- Modal -->
        
        <script src="../administracion/administracion.js/XmlComprobante.js"></script>
        <script src="../administracion/administracion.js/XmlConceptos.js"></script>
        <script src="../administracion/administracion.js/controlWizard.js"></script>
        <script src="../administracion/administracion.js/entradas.js"></script>
        <script src="../administracion/administracion.js/xmlEntradas.js"></script>
        <script src="../administracion/administracion.js/xmlCalculos.js"></script>
        <script src="../administracion/administracion.js/clasificados.js"></script>
        <script src="../utilerias/validCampoFranz.js"></script>
    </body>
</html>
<!--<input type="tex