<?php ?>
<!DOCTYPE html>
<html lang="es">
    <body>
        <div id="wizard">
            <h2><span class="glyphicon glyphicon-list-alt"/>&numsp;Administradores activos del sistema</h2>
            <section>
                <div id="loadadminactivos"></div>
            </section>
            <h2><span class="glyphicon glyphicon-list-alt"/>&numsp;Vendedores activos del sistema</h2>
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
                                        <input type="text" class="form-control nonull sololetras" id="txtNombre" placeholder="">
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="apellidoPaterno">Apellido Paterno</label>
                                                <input type="text" class="form-control nonull sololetras" id="txtApellidoPaterno" placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="apellidoMaterno">Apellido Materno</label>
                                                <input type="text" class="form-control nonull sololetras" id="txtApellidoMaterno" placeholder="">
                                            </div>
                                        </div>
                                    </div>  

                                    <div class="form-group">
                                        <label for="email">Nombre de usuario</label>
                                        <input type="email" class="form-control nonull" id="txtEmail" placeholder="">
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="pass">Password</label>
                                                <input type="password" class="form-control nonull" id="txtPass" placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="pass2">Confirmar password</label>
                                                <input type="password" class="form-control nonull" id="txtPass2" placeholder="">
                                            </div>
                                        </div>
                                    </div>      
                                    <div class="row">
                                        <div class="col-md-6 pull-right">
                                            <button class="btn btn-cprimary pull-right" type="button" id="">Registrar</button>                        
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