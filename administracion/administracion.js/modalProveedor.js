$(document).ready(function() {
    $(function() {
        $('#txtrfc').validCampoFranz('0123456789abcdefghijklmnñopqrstuvwxyzáéiou');
        $('#txtdiascredito').validCampoFranz('0123456789');
        $('#txtdescuento').validCampoFranz('0123456789');
    });
    $("#btnguardarproveedor").click(function() {
        var nombre = $("#txtnombreproveedor").val();
        var rfc = $("#txtrfc").val();
        var diascredito = $("#txtdiascredito").val();
        var descuento = $("#txtdescuento").val();
        if (nombre == "" || rfc == "" || diascredito == "" || descuento == "") {
            alertify.error("Todos los campos son obligatorios");
            return false;
        }
        else {
            var info = "nombre=" + nombre + "&rfc=" + rfc + "&diascredito=" + diascredito + "&descuento=" + descuento;
            $.get('guardaProveedor.php', info, function(respuesta) {
                var info = respuesta;
                if (info == 1)
                {
                    alertify.error("No guardaste una direccion");
                    return false;
                } else {
                    alertify.success("Proveedor agregado correctamente");
                    return false;
                }
            });
        }
    });
});

