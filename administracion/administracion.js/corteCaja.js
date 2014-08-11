$(document).ready(function() {
    $("#InformacionDia").hide();

    $("#btnBuscarHoy").click(function() {
        $("#InformacionDia").load("dameInformcacionCorteCaja.php", function() {
            $("#InformacionDia").slideDown('slow');
        });
    });
    $("#btnActualizarHoy").click(function() {
        $("#InformacionDia").slideUp('slow', function() {
            $("#InformacionDia").load("dameInformcacionCorteCaja.php", function() {
                $("#InformacionDia").slideDown('slow');
            });
        });
    });
    $("#btnBuscarPorFechas").click(function() {
        var fecha1 = $("#txtFecha1").val();
        var fecha2 = $("#txtFecha2").val();
        $("#InformacionDia").slideUp('slow');
        if (fecha1 == "" || fecha2 == "") {
            alertify.error("Seleccione las dos fechas");
        }
        else {
            if (Date.parse(fecha1) > Date.parse(fecha2)) {
                alertify.error("La fecha 1 debe ser menor que la fecha 2");
            }
            else {
                var nuevaFecha1 = fecha1.split("-");
                var nuevaFecha2 = fecha2.split("-");
                fecha1 = nuevaFecha1[2] + "/" + nuevaFecha1[1] + "/" + nuevaFecha1[0];
                fecha2 = nuevaFecha2[2] + "/" + nuevaFecha2[1] + "/" + nuevaFecha2[0];

                $("#InformacionDia").load("dameInformacionCorteCajaFechas.php?fecha1=" + fecha1 + "&fecha2=" + fecha2, function() {
                    $("#InformacionDia").slideDown('slow');
                });
            }
        }
    });

    $("#btnFinalizarlo").click(function() {
        $("#mdlAutorizacionFinalizarCaja").modal("show");
    });

    $("#btnAutorizarF").click(function() {
        var usuario = $("#txtusuarioF").val();
        var pass = $("#txtPassF").val();
        if (usuario == "" || pass == "") {
            alertify.error("Todos los campos son obligatorios");
        }
        else {
            validarUsuarioCorteCaja(usuario, pass);
        }

    });
    function validarUsuarioCorteCaja(usuario, password) {
        var informacion = "usuario=" + usuario + "&pass=" + password;
        $.get('validarAdministrador.php', informacion, function(autorizacion) {
            if (autorizacion == 1) {
                var callbacks = $.Callbacks();
                callbacks.add($("#mdlAutorizacionFinalizarCaja").modal("hide"));
                callbacks.add($("#mdlCorteCaja").modal("show"));
                callbacks.add($("#txtusuarioF").val(""));
                callbacks.add($("#txtPassF").val(""));
            }
            else {
                alertify.error(autorizacion);
            }
        });
    }


});


