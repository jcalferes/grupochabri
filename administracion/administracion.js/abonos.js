$(document).ready(function() {
    $("#creditopagado").hide();
    $("#divabonos").hide();
    $("#slctipopago").load("mostrarTiposPagos.php", function() {
        $("#slctipopago").selectpicker();
    });
    $("#buscabonos").load("consultarDeudoresPV.php", function() {
        $('#dtdeudores').dataTable();
    });
});

$("#btnabonos").click(function() {
    $('#mdlabonos').modal('toggle');
});

//============ UTILIDADES ======================================================
function NumCheck(e, field, tarifa) {
    key = e.keyCode ? e.keyCode : e.which
    if (key == 15)
        return true
    if (key > 47 && key < 58) {
        if (field.value == "")
            return true
        regexp = /.[0-9]{20}$/
        return !(regexp.test(field.value))
    }
    if (key == 46) {
        if (field.value == "")
            return false
        regexp = /^[0-9]+$/
        return regexp.test(field.value)
    }
    return false
}

//=========== TERMINA UTILIDADES ===============================================

$("#txtfolioabonos").blur(function() {
    var folio = $("#txtfolioabonos").val();
    var info = "folio=" + folio;
    var pagado = 0;
    if (folio === "" || /^\s+$/.test(folio)) {
        $("#txtfolioabonos").val("");
        $("#buscabonos").slideDown();
        $("#divabonos").slideUp();
    } else {
        $.get('consultarDatosAbonos.php', info, function(rs) {
            if (rs != 0) {
                $("#buscabonos").slideUp();
                var arr = $.parseJSON(rs);
                $("#nombreabono").text(arr.cliente.nombre);
                $("#rfcabono").text(arr.cliente.rfc);
                $("#creditoabono").text(arr.cliente.credito);
                $("#adeudoabono").text(arr.cliente.totalComprobante);
                $("#tblabonos").load("consultarAbonos.php?folio=" + folio, function() {
                    $("#dtabonos").dataTable();
                    $("#dtabonos").find('.importeabonos').each(function() {
                        var elemento = this;
                        var valor = elemento.value;
                        pagado = pagado + parseFloat(valor);
                    });
                    var saldo = arr.cliente.totalComprobante - pagado;
                    $("#pagadoabono").text(pagado);
                    $("#saldoabono").text(saldo);

                    if (saldo == 0) {
                        $("#btnabonar").attr("disabled", "disabled");
                        $("#creditopagado").show();
                    }

//                $("#mdldialog").attr("style", "width: 80%");
//                    $("#mdldialog").css("width", "80%");
//                document.getElementById("mdldialog").style.width = "80%";
                    $("#divabonos").slideDown();
                });
            } else {
                $("#txtfolioabonos").val("");
                $("#buscabonos").slideDown();
                $("#divabonos").slideUp();
                alertify.error("No hay coincidencias de crédito  con el folio ingresado");
            }
        });
    }
});

function ree() {
    var folio = $("#txtfolioabonos").val();
    var info = "folio=" + folio;
    var pagado = 0;
    if (folio === "" || /^\s+$/.test(folio)) {
        $("#txtfolioabonos").val("");
    } else {
        $.get('consultarDatosAbonos.php', info, function(rs) {
            if (rs != 0) {
                var arr = $.parseJSON(rs);
                $("#nombreabono").text(arr.cliente.nombre);
                $("#rfcabono").text(arr.cliente.rfc);
                $("#creditoabono").text(arr.cliente.credito);
                $("#adeudoabono").text(arr.cliente.totalComprobante);
                $("#tblabonos").load("consultarAbonos.php?folio=" + folio, function() {
                    $("#dtabonos").dataTable();
                    $("#dtabonos").find('.importeabonos').each(function() {
                        var elemento = this;
                        var valor = elemento.value;
                        pagado = pagado + parseFloat(valor);
                    });
                    var saldo = arr.cliente.totalComprobante - pagado;
                    $("#pagadoabono").text(pagado);
                    $("#saldoabono").text(saldo);

                    if (saldo == 0) {
                        $("#btnabonar").attr("disabled", "disabled");
                        $("#creditopagado").show();
                    }
                });
            }
        });
    }
}

$("#btncancelarabono").click(function() {
    $("#txtfolioabonos").val("");
    $("#buscabonos").slideDown();
    $("#divabonos").slideUp();
});

$("#btnabonar").click(function() {
    var folio = $("#txtfolioabonos").val();
    var monto = $("#txtcantidadabono").val();
    var tipopago = $("#slctipopago").val();
    var referencia = $("#txtreferenciaabono").val();
    var observ = $("#txtobservacionesabono").val();
    var saldoInicial = $("#saldoabono").text()
    var liquida = false;


    if (monto === "" || /^\s+$/.test(monto) || referencia === "" || /^\s+$/.test(referencia)) {
        alertify.error("Todos los capos con * son abligatorios para poder abonar");
        return false;
    } else {
        if (tipopago == 0) {
            alertify.error("No seleccionaste un tipo de pago");
            return false;
        }
    }

    if (observ === "" || /^\s+$/.test(observ)) {
        observ = "NA";
    }

    var adeudo = parseFloat($("#adeudoabono").text());
    var pagado = parseFloat($("#pagadoabono").text());

    var liquidado = pagado + parseFloat(monto);
    if (liquidado >= adeudo) {
        liquida = true;
    }

    var saldo = saldoInicial - monto;

    var info = "folio=" + folio + "&monto=" + monto + "&tipopago=" + tipopago + "&referencia=" + referencia + "&observ=" + observ + "&liquida=" + liquida + "&saldo=" + saldo;
    $.get('guardarAbono.php', info, function(rs) {
        if (rs == 0) {
            alertify.success("Abono registrado");
            ree();
            $("#txtcantidadabono").val("");
            $("#slctipopago").selectpicker('val', 0);
            $("#txtreferenciaabono").val("");
            $("#txtobservacionesabono").val("");
        } else {
            alert("ERROR: NO SE PUDO REGISTAR ABONO");
        }
    });
});