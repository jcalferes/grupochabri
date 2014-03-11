
<!DOCTYPE html>
<html lang="es">
    <body>
        <div id="wizard">
            <h2><span class="glyphicon glyphicon-th-list"/>&numsp;Usuarios</h2>
            <section >
            </section>
            <h2><span class="glyphicon glyphicon-plus"/>&numsp;Nuevo Usuario</h2>
            <section >
                <form style="margin: 0% 25% 0% 25%">
                    <div class="form-group">
                        <label>Tipo de Usuario:</label><br>
                        <select id="selectTipoUsuario" class="selectpicker selectores" data-container="body" data-live-search="true" >
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Usuario:</label><br>
                        <input type="text" id="txtusuario" class="form-control" style="width: 50%"/>
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
                        <input type="text" id="txtpass" class="form-control" style="width: 50%" />
                    </div>
                    <div id="frmrepass" class="form-group">
                        <label>Validar Password:</label><br>
                        <input type="text" id="txtrepass" class="form-control" style="width: 50%" />
                    </div>
                    <hr>
                    <input type="button" id="btnusuario" class="form-control btn btn-primary" value="Guardar" style="width: 50%" />
                </form>
            </section>
        </div>
        <script src="../administracion/administracion.js/controlWizard.js"></script>
        <script src="../utilerias/validCampoFranz.js"></script>   
        <script src="administracion.js/usuario.js"></script>   
    </body>
</html>
