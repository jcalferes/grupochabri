
$(document).ready(function() {
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
                    $("#detalle").html(informacion);
                    $("#selecionarProveedor").selectpicker();
//                    $("#cantidadMinima").focus();
                    $("#datosCaptura").slideDown(1000);
                }
                $("#detalle").slideDown('slow');
            });
        }
    });
    $("#guardarEntradas").click(function() {
        var codigo = $("#codigoProducto").val();
        var informacion = "codigo= " + codigo + "&cant=" + $("#cantidad").val();
        if (codigo == "" || $("#cantidad").val() == "") {
            alertify.error("Error! LLene todos los campos");
        }
        else {
            $.get('guardarEntradas.php', informacion, function() {
                $("#codigoProducto").val('');
                $("#cantidad").val('');
                alertify.success("Exito! Nuevos Productos Insertados");
                $("#tablaEntradas").load("mostrarEntradas.php");
                $("#datosCaptura").slideUp(1000);
                $("#detalle").slideUp('slow');
                return false;
            });
        }
    });

    $("#buscarCodigo").click(function() {
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
                $("#detalle").html(informacion);
                $("#selecionarProveedor").selectpicker();
//                    $("#cantidadMinima").focus();
                $("#datosCaptura").slideDown(1000);
            }
            $("#detalle").slideDown('slow');
        });
    });
});



