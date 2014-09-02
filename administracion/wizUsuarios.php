
<!DOCTYPE html>
<html lang="es">
    <body>
        <div id="wizard">
            <h2><span class="glyphicon glyphicon-th-list"/>&numsp;Usuarios</h2>
            <section >
                <div id="consultaUsuario">
                </div>
            </section>
            <h2><span class="glyphicon glyphicon-plus"/>&numsp;Nuevo Usuario</h2>
            <section >
                <form style="margin: 0% 25% 0% 25%">
                    <div class="form-group">
                        <label>Usuario:</label><br>
                        <input type="text" id="txtusuario" class="form-control" style="width: 50%"/>
                        <input type="text" id="txtid" class="form-control hidden"  disabled="true" style="width: 50%" />
                    </div>
                    <div class="form-group">
                        <label>Tipo de Usuario:</label><br>
                        <select id="selectTipoUsuario" class="selectpicker selectores" data-container="body" data-live-search="true" >
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Nombre:</label><br>
                        <input type="text" id="txtnombre" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label>Apellido Paterno:</label><br>
                        <input type="text" id="txtpaterno" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label>Apellido Materno:</label><br>
                        <input type="text" id="txtmaterno" class="form-control" />
                    </div>
                    <div id="frmpass" class="form-group">
                        <label>Password:</label><br>
                        <input type="password" id="txtpass" class="form-control" style="width: 50%" />
                    </div>
                    <div id="frmrepass" class="form-group">
                        <label>Validar Password:</label><br>
                        <input type="password" id="txtrepass" class="form-control" style="width: 50%" />
                    </div>
                    <hr>
                    <div id="divguardarusuario" class="form-group">
                        <input type="button" id="btnguardarusuario" class="form-control btn btn-cprimary" value="Guardar" style="width: 25%" />
                        <input type="button" id="btnlimpiadata" class="form-control btn btn-default" value="Limpiar" style="width: 25%" />
                    </div>
                    <div id="diveditarusuario" class="form-group form-inline">
                        <input type="button" id="btneditarusuario" class="form-control btn btn-cprimary" value="Editar" style="width: 25%" />
                        <input type="button" id="btneliminarusuario" class="form-control btn btn-default" value="Eliminar" style="width: 25%" />
                        <input type="button" id="btnlimpiadata2" class="form-control btn btn-default" value="Limpiar" style="width: 25%" />
                    </div>
                </form>
            </section>
<!--            <h2><span class="glyphicon glyphicon-th-list"/>&numsp;Consulta de Maquinas</h2>
            <section>
                <div id="consultaMaquina" style="margin: 0% 25% 0% 25%">
                </div>
            </section>
            <h2><span class="glyphicon glyphicon-plus"/>&numsp;Nueva Maquina</h2>
            <section>
                <form style="margin: 0% 25% 0% 25%">
                    <div class="form-group">
                        <label>Nombre de la maquina:</label>
                        <input type="text" class="form-control" id="txtnombremaquina" placeholder="Ingrese el nombre de la nueva maquina">
                    </div>
                    <hr>
                    <input id="canceloMarca" type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar"/>
                    <input id="btnguardarmaquina" type="button" class="btn btn-cprimary" data-dismiss="modal" value="Guardar"/>
                </form>
            </section>-->
        </div>
        <script src="../administracion/administracion.js/controlWizard.js"></script>
        <script src="../utilerias/validCampoFranz.js"></script>   
        <script src="administracion.js/usuario.js"></script>   
        <script src="administracion.js/maquinas.js"></script>
    </body>
</html>
