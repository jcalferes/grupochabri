
$(document).ready(function() {
    $("#codigoProducto").focus();
    $("#tablaEntradas").load("mostrarEntradas.php");
    $("#detalle").hide();
    $("#datosCaptura").hide();
    $("#codigoProducto").keypress(function(e) {
        if (e.which == 13) {
            $("#detalle").slideUp("1000");
            $("#datosCaptura").slideUp('slow');
            $("#detalle").html("<div></div>");
            var info = "codigoProducto=" + $("#codigoProducto").val();
            $.get('mostrarInformacionProducto.php', info, function(informacion) {
                if (informacion == 1) {
                    $("#detalle").html("<div><strong>No existe Información de este Producto</strong></div>");
                    $("#codigoProducto").focus();
                }
                else {
//                     $("#codigoProducto").blur();
                    $("#detalle").html(informacion);
//                    $("#cantidadMinima").focus();
                    $("#datosCaptura").slideDown(1000);
                }
                $("#detalle").slideDown('slow');
            });
        }
    });

    $("#guardarEntradas").click(function() {
        var informacion = "codigoProducto =" + $("#codigoProducto").val() + "&cant=" + $("#cantidad").val() + "&cantMinima=" + $("#cantidadMinima").val() + "&cantidadMaxima=" + $("#cantidadMaxima").val();

    });
});



