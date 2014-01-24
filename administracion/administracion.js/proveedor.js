$(document).ready(function() {
    $("#consultaProveedor").load("consultarProveedor.php");
    $(function() {
        $('#txtrfc').validCampoFranz('0123456789abcdefghijklmnñopqrstuvwxyzáéiou');
        $('#txtdiascredito').validCampoFranz('0123456789');
        $('#txtdescuento').validCampoFranz('0123456789');
    });

    $("#btncanceloProvedor").click(function() {
        $("#txtnombreproveedor").val("");
        $("#txtrfc").val("");
        $("#txtdiascredito").val("");
        $("#txtdescuento").val("");
        $("#formulario").show("slow");
        $("#mostrarDivProveedor").hide("slow");

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
                if (info == 2)
                {
                    alertify.error("RFC no valido");
                    return false;
                }
                if (info == 3)
                {
                    alertify.error("Error al gurdar direccion");
                    return false;
                }
                if (info == 1)
                {
                    alertify.error("No agregaste una direccion");
                    return false;
                } else {
                    $("#consultaProveedor").load("consultarProveedor.php");
                    alertify.success("Proveedor agregado correctamente");
                    return false;


                }
            });
        }
    });
});


