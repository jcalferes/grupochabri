<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="shortcut icon" href="">
        <title>"Aqui en nombre de la pagina actual" - Grupo Chabri  </title>
        <!-- CSS -->
        <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="../bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">
        <!-- CSS personalizados -->
        <link href="../bootstrap/css/misestilos/estilonavbar.css" rel="stylesheet">
    </head>
    <body>

        <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
            Launch demo modal
        </button>

        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Nuevo Producto</h4>
                    </div>
                    <form id="cuerpo">
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="text" class="form-control" id="txtNombreProducto" placeholder="Nombre del producto" required>
                            </div>

                            <div class="form-group" id="marca">
                                <select id="selectMarca">
                                    <option value="0"> seleccione una marca</option>

                                </select>
                                <input href="#mdlMarca" data-toggle="modal" type="button" class="btn btn-primary" value="Agregar Marca">
                            </div>

                            <div class="form-group">
                                <select id="selectProveedor">
                                    <option>

                                    </option>

                                </select>
                            </div>

                            <div class="form-group">
                                <select id="selectListaPrecios" class="jojo">
                                    <option>

                                    </option>

                                </select>
                            </div>
                            <div class="form-group">
                                <label>Mensage</label>
                                <textarea id="txamensaje" name="mensaje" class="form-control" rows="10" id="contactMessage"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar"/>
                            <input type="submit" class="btn btn-primary" value="Guardar" id="guardarDatos"/>
                        </div>
                    </form>

                    <form id="probando">
                        <div class="form-group">
                            <input type="text" class="form-control" id="txtdsad" placeholder="Agregar Marca" required>
                        </div>
                        <div class="modal-footer">
                            <input type="button"  value="Cancelar" id="cancelar"/>
                            <input type="submit" id="guardarDato"/>
                        </div>
                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <!-- JSCRIPT -->
        <script src="../bootstrap/js/jquery.js"></script>
        <script type="text/javascript" src="administracion.js/modalProducto.js"></script>
        <script src="../bootstrap/js/bootstrap.min.js"></script>
    </body>
</html>