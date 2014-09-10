$(document).ready(function () {
    $("#textAcciones").val("");
    $("#InformacionDia").hide();
    $("#InformacionDia").load("dameInformcacionCorteCaja.php", function () {
        $("#InformacionDia").slideDown('slow');
    });
    $("#btnBuscarHoy").click(function () {
        $("#InformacionDia").load("dameInformcacionCorteCaja.php", function () {
            $("#InformacionDia").slideDown('slow');
        });
    });
    $("#btnActualizarHoy").click(function () {
        $("#InformacionDia").slideUp('slow', function () {
            $("#InformacionDia").load("dameInformcacionCorteCaja.php", function () {
                $("#InformacionDia").slideDown('slow');
            });
        });
    });
    $("#btnBuscarPorFechas").click(function () {
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

                $("#InformacionDia").load("dameInformacionCorteCajaFechas.php?fecha1=" + fecha1 + "&fecha2=" + fecha2, function () {
                    $("#InformacionDia").slideDown('slow');
                });
            }
        }
    });

    $("#btnFinalizarlo").click(function () {
        $("#InformacionDia").slideUp('slow', function () {
            $("#InformacionDia").load("dameInformcacionCorteCaja.php", function () {
                $("#InformacionDia").slideDown('slow');
                $("#mdlAutorizacionFinalizarCaja").modal("show");
            });
        });

    });

    $("#btnAutorizarF").click(function () {
        var total = $("#totalDelDia").text();
        $("#totalFinalizarCaja").text(total);
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
        $.get('validarAdministrador.php', informacion, function (autorizacion) {
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


    $("#btnCorteCaja").click(function () {
        var cantidadCaja = $("#cantidadCaja").val();
        var cuadroCaja = 0;
        var observaciones = $("#textAcciones").val();
        if ($("#cuadroCaja").is(":checked")) {
            cuadroCaja = 1;
        } else {
            cuadroCaja = 0;
        }
        var cantidadSistema = $("#totalFinalizarCaja").text();
        cantidadSistema = cantidadSistema.replace(/\s/g, ",");
        var cantidadS = cantidadSistema.split(',');
        var informacion = "cantidadCaja=" + cantidadCaja + "&cuadro=" + cuadroCaja + "&cantidadSistema=" + cantidadS[1] + "&observaciones=" + observaciones;
        $.get('finalizarCaja.php', informacion, function (respuesta) {
            alertify.success(respuesta);
            var callbacks = $.Callbacks();
            callbacks.add(alertify.alert("Se finalizo la caja", function () {
                location.reload();
            }));
//            $("#mdlCorteCaja").modal("hide");
//           
        });

    });

});

function mostrarInformacionDetalleVenta2(folioComprobante) {
    $("#tablaDetalleCorteCaja").load("dameDetalleVentaCorteCaja.php?folio=" + folioComprobante, function () {
        $("#mdlDetalleVenta").modal('show');
    });
}

function mostrarInformacionDetalleCancelacionVenta(folioComprobante) {
    $("#tablaDetalleCorteCaja").load("dameDetalleCancelacionNotaCredito.php?folio=" + folioComprobante, function () {
        $("#mdlDetalleVenta").modal('show');
    });
}

function mostrarInformacionDetalleAbonos(folioComprobante, status) {
    $("#tablaDetalleCorteCaja").load("dameDetalleVentaAbonos.php?folio=" + folioComprobante+ "&status="+status, function () {
        $("#mdlDetalleVenta").modal('show');
    });
}


function mostrarInformacionDetalleNotaCredito(folioComprobante) {
    $("#tablaDetalleCorteCaja").load("dameDetalleVentaNotaCredito.php?folio=" + folioComprobante+ "&status=7", function () {
        $("#mdlDetalleVenta").modal('show');
    });
}


