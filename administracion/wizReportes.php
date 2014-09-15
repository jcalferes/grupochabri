<?php ?>
<!DOCTYPE html>
<html lang="es">
    <body>
        <div id="wizard">
            <h2><span class="glyphicon glyphicon-list-alt"/>&numsp;De inventario</h2>
            <section>
                <div style="margin: 0% 25% 0% 25%" id="fabricar_consulta">
                    <div class="form-group">
                        <label>¿Que deseas consultar? </label><br>
                        <select id="slc_inventario"  class="selectpicker" data-container="body" data-width="auto">
                            <option value="0">Selecciona una opcion</option>
                            <option value="1">Cancelaciones</option>
                            <option value="2">Ventas</option>
                        </select>
                    </div>
                    <div id="losparametros" class="form-group">
                        <label>Que parametros se usaran:</label><br>
                        <div class="radio">
                            <label>
                                <input type="radio" name="optionsRadios" id="rbtn1" value="option1" checked>
                                Todos los datos
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="optionsRadios" id="rbtn2" value="option2">
                                Por rango de fechas
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="optionsRadios" id="rbtn3" value="option2">
                                Por por cliente
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" class="nocancel" name="optionsRadios" id="rbtn4" value="option2">
                                Por vendedor
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="optionsRadios" id="rbtn5" value="option2">
                                Por cliente en un rango de fechas
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" class="nocancel" name="optionsRadios" id="rbtn6" value="option2">
                                Por vendedor en un rango de fechas
                            </label>
                        </div>
                    </div>
                    <div id="esporvendedor" class="form-inline form-group">
                        <label>Dame nombre de usuario del vendedor:</label><br>
                        <input type="text" class="form-control" id="txt_user"/>
                    </div>
                    <div id="esporcliente" class="form-inline form-group">
                        <label>Dame el RFC del cliente:</label><br>
                        <input type="text" class="form-control" id="txt_rfc"/>
                    </div>
                    <div id="esporfecha" class="form-inline form-group">
                        <label>Dame el rango de fechas:</label><br>
                        <span>Desde:</span>
                        <input type="date" class="form-control" id="fecha_inicial">
                        <span>Hasta:</span>
                        <input type="date" class="form-control" id="fecha_final">
                    </div>
                    <button type="button" class="btn btn-cprimary" id="btnhacerconsulta" >Consultar</button>
                    <button type="button" class="btn btn-default" id="btnlimpiarconsulta" >Limpiar</button>
                </div>
                <div id="mostrardatosconsulta">
                </div>
            </section>
        </div>
        <script src="../administracion/administracion.js/controlWizard.js"></script>
        <script src="administracion.js/reportes.js"></script>
    </body>
</html>