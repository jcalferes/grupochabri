<?php ?>
<!DOCTYPE html>
<html lang="es">
    <body>
        <div id="wizard">
            <h2><span class="glyphicon glyphicon-list-alt"/>&numsp;Administradores activos</h2>
            <section>
                <div id="loadadminactivos"></div>
            </section>
            <h2><span class="glyphicon glyphicon-list-alt"/>&numsp;Vendedores activos</h2>
            <section>
                <div id="loadvendeactivos"></div>
            </section>
            <h2><span class="glyphicon glyphicon-plus"/>&numsp;Crear nuevo usuario</h2>
            <section>
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2 col-sm-6 col-sm-offset-3">
                            <div class="form-body">
                                <form class="form-light padding-15">
                                    <div class="form-group">
                                        <label for="nombre">Nombre</label>
                                        <input type="text" class="form-control nonull sololetras" id="txtnombre" placeholder="">
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="apellidoPaterno">Apellido Paterno</label>
                                                <input type="text" class="form-control nonull sololetras" id="txtapaterno" placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="apellidoMaterno">Apellido Materno</label>
                                                <input type="text" class="form-control nonull sololetras" id="txtamaterno" placeholder="">
                                            </div>
                                        </div>
                                    </div>  
                                    <div class="form-group">
                                        <label>Tipo de Usuario:</label><br>
                                        <select id="slctipousuario" class="selectpicker selectores" data-container="body" data-width="auto">
                                            <option value="0">Selecciona una opcion...</option>
                                            <option value="1">Super Administrador</option>
                                            <option value="2">Administrador</option>
                                            <option value="3">Vendedor</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Nombre de usuario</label>
                                        <input type="email" class="form-control nonull" id="txtemail" placeholder="">
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="pass">Password</label>
                                                <input type="password" class="form-control nonull" id="txtpass" placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="pass2">Confirmar password</label>
                                                <input type="password" class="form-control nonull" id="txtpass2" placeholder="">
                                            </div>
                                        </div>
                                    </div>      
                                    <div class="row">
                                        <div class="col-md-6 pull-right">
                                            <button class="btn btn-cprimary pull-right" type="button" id="btnregistrar">Registrar</button>                        
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <script src="../administracion/administracion.js/controlWizard.js"></script>
        <script src="../administracion/administracion.js/su_administradores.js"></script>
    </body>
</html>