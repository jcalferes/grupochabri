<?php ?>
<!DOCTYPE html>
<html lang="es">
    <body>
        <div id="wizard">
            <h2><span class="glyphicon glyphicon-th-list"/>&numsp;Precio Venta Producto</h2>
            <section>
                 <div class="input-append" style="float: left; margin-left: 40px">
                     <input  list="valor" id="ProductoLista"/>
                        <datalist  id="valor">
                            <option id="producto"></option>
                        </datalist>
                        <input type="submit" class="btn btn-primary" value="AgregarTarifa" id="Buscar"/>
                       </div>
                <div id="consultaTarifas" style="margin-left: 5%">
                    <select id="selectTarifa" style="width: 90%; height: 35px">
                    </select>
                    <div id="tablaTarifas" style="margin-left: 5%">
                      
                    </div>
                </div>
            </section>
            <h2><span class="glyphicon glyphicon-plus"/>&numsp;Agregar Precio Venta</h2>
            <section>
                <form style="margin: 0% 25% 0% 25%">



                </form>
            </section>


        </div>






        <script src="../administracion/administracion.js/controlWizard.js"></script>
        <script src="../utilerias/validCampoFranz.js"></script>   
         <script src="../administracion/administracion.js/tarifas.js"></script>
    </body>
</html>
