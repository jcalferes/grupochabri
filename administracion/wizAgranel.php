<?php ?>
<!DOCTYPE html>
<html lang="es">
    <body>
        <div id="wizard">
            <h2><span class="glyphicon glyphicon-list-alt"/>&numsp;Tabla de productos a granel</h2>
            <section>
                <div id="showGranel" style="margin: 0% 25% 0% 25%">
                </div>
            </section>
            <h2><span class="glyphicon glyphicon-plus"/>&numsp;Agregar a granel</h2>
            <section>
                <div style="margin: 0% 25% 0% 25%">
                    <div class="form-group">
                        <label>Codigo del producto padre:</label>
                        <div class="input-group" style="width: 60%">
                            <input type="text" class="form-control" id="txtcodigogranel">
                            <span class="input-group-addon">-GR</span>
                        </div>
                    </div>
                    <div id="divincremento">
                        <div class="well well-sm">
                            <div class="form-group">
                                <h3><b>Datos producto padre :</b></h3>
                                <label>Nombre : </label><span id="nombrep">|</span><br>
                                <label>Existencias (Unidades) disponibles : </label><span id="existenciap">|</span><br>
                                <label>Contenido : </label><span id="contenidop">|</span>
                            </div>
                        </div>
                        <div class="well well-sm">
                            <div class="form-group">
                                <h3><b>Datos producto hijo (granel) :</b></h3>
                                <label>Nombre : </label><span id="nombreg">|</span><br>
                                <label>Existencia (Contenido) disponible : </label><span id="existenciag">|</span>
                            </div>
                        </div>
                        <hr>
                        <input id="btnvalidar" type="button" class="btn btn-cprimary" value="Incrementear producto a granel"/>
                        <input id="btncancel" type="button" class="btn btn-default" value="Cancelar"/>
                    </div>
                </div>
            </section>
        </div>
        <script src="../administracion/administracion.js/controlWizard.js"></script>
        <script src="../administracion/administracion.js/agranel.js"></script>
    </body>
</html>