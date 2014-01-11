<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="shortcut icon" href="">
        <title>Nuevo proveedor - Grupo Chabri  </title>
        <!-- CSS -->
        <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="../bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">
        <link href="../alertify/themes/alertify.core.css" rel="stylesheet">
        <link href="../alertify/themes/alertify.bootstrap.css" rel="stylesheet">
        <!-- CSS personalizados -->
        <link href="../bootstrap/css/misestilos/estilonavbar.css" rel="stylesheet">
    </head>
    <body>
        <!-- Button trigger modal -->
        <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
            Launch demo modal
        </button>
        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Nuevo Proveedor</h4>
                    </div>
                    <form>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Nombre:</label>
                                <input type="text" class="form-control" id="txtnombre" placeholder="Ingrese el nombre del proveedor">
                            </div>
                            <div class="form-group">
                                <label>Direccion:</label>
                                <div class="input-group">
                                    <input id="txtdireccion" type="text" class="form-control" placeholder="Seleccion un id de direccion">
                                    <span class="input-group-btn">
                                        <button id="btnnuevadireccion" class="btn btn-default" type="button">Nueva direccion</button>
                                    </span>
                                </div><!-- /input-group -->
                            </div>
                            <div class="form-group">
                                <label>RFC:</label>
                                <input type="text" class="form-control" id="txtrfc" placeholder="Ingrese el RFC del proveedor">
                            </div>
                            <div class="form-group">
                                <label>Dias de credito:</label>
                                <input id="txtdiascredito" type="number" class="form-control"  placeholder="Ingrese los dias de credito">
                            </div>
                            <div class="form-group">
                                <label>Descuento:</label>
                                <input id="txtdescuento" type="number" class="form-control"  placeholder="Ingrese el descuento">
                            </div>
                            <div class="modal-footer">
                                <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar"/>
                                <input id="btnguardar" type="button" class="btn btn-primary" value="Guardar"/>
                            </div>
                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <!-- JSCRIPT -->
        <script src="../bootstrap/js/jquery.js"></script>
        <script src="../bootstrap/js/bootstrap.min.js"></script>
        <script src="../alertify/lib/alertify.min.js"></script>
        <script src="administracion.js/modalProveedor.js"></script>   
    </body>
</html>

