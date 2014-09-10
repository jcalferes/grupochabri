var idTipoPago;
var folioventa;

$(document).ready(function () {
    $("#pagarCobranza").hide();
    $("#tableAcompletarPagos").hide();

    $("#mdlBuscadorOrdenesCompra").click(function () {
        var folio = $.trim($("#txtFolioCobrar").val());
        if (folio == "") {
            $("#tableOrdenesCompra").load("dameTodasOrdenesCompra.php", function () {
                $("#mdlBusquedaOrdenCompra").modal("show");
            });
        }
        else {
            var callbacks = $.Callbacks();
            callbacks.add(cargarInformacionFolios(folio));
            callbacks.add(idTipoPago = $("#lblTipoPago1").text());
        }
    });

    $("#btnCobrar").click(function () {
        var total1 = $("#totalV").text();
        $("#totalVnt").text(total1);
        if (idTipoPago == 2) {
            $("#pagarCobranza").show();
        }
        else if (idTipoPago != 2) {
            $("#pagarCobranza").hide();
        }
        if (idTipoPago == "") {
            idTipoPago = $("#lblTipoPago1").text();
        }
        if (idTipoPago == 5) {
            var total = $("#totalV").text();
            var rfcCliente = $("#rfcCliente").text();
            $("#informacionNotaCredito").load("dameInformacionNotaCredito.php?total=" + total + "&cliente=" + rfcCliente, function () {
                $("#idClienteNC").hide();
                $("#idNotasCredito").hide();
                $("#mdlNotacreditoInformacion").modal('show');
                var total = $("#totalDisponibleNotaCredito").text();
                if (total < 0) {
                    total = (total * -1);
                    $("#acompletarNotaCredito").val(total);
                    $("#tableAcompletarPagos").show();
                }
                else {
                    $("#acompletarNotaCredito").val("");
                    $("#tableAcompletarPagos").hide();
                }
            });
        }
        else {
            $('#mdlPagar').modal('show');
        }
    });


    $("#btnGuardarNotaCredito").click(function () {
        var idCliente = $("#idClienteNC").text();
        var total = $("#totalDisponibleNotaCredito").text();
        var idNotasCredito = $("#idNotasCredito").text();
        if ($("#acompletarNotaCredito").val() == "") {
            var info = "idCliente=" + idCliente + "&total=" + total + "&idNotasCredito=" + idNotasCredito + "&folioVnta=" + folioventa;
            $.post('guardarNotaCredito.php', info, function (resultado) {
                if (resultado > 0) {
                    alertify.success("Exito venta concretada");
                    window.open('generarNotaCompra.php?folio=' + resultado + "&tipo=7");
                    $("#mdlNotacreditoInformacion").modal('hide');
                    limpiarOrdenesCompra();
                    $('#btnCobrar').attr("disabled", true);
                    $('#btnRechazar').attr("disabled", true);
                    $('#btnCancelarCobranzas').attr("disabled", true);
                    $("#txtFolioCobrar").val("");
                }
                else {
                    alertify.success(resultado);
                }
            });
        }
        else {
            var tipoPagoElegir = $("#tiposPagosNotasCredito").val();
            var totalCreditoenviado = $("#totalV").text();
            var cantidadAcompletar = $("#acompletarNotaCredito").val();
            if (tipoPagoElegir == 5 || tipoPagoElegir == 7 || tipoPagoElegir == 2) {
                alertify.success("Elige otro tipo de pago");
            }
            else if ($.trim(cantidadAcompletar) == "") {
                alertify.success("Escriba la cantidad a acompletar de la nota de credito");
            }
            else {
                var info = "idCliente=" + idCliente + "&total=" + total + "&idNotasCredito=" + idNotasCredito + "&folioVnta=" + folioventa + "&tipoPago=" + tipoPagoElegir + "&cantidad=" + cantidadAcompletar + "&totalCredito=" + totalCreditoenviado;
                $.post('guardarNotaCreditoVariosPagos.php', info, function (resultado) {
                    if (resultado > 0) {
                        alertify.success("Exito venta concretada");
                        window.open('generarNotaCompra.php?folio=' + resultado + '&tipo=7');
                        $("#mdlNotacreditoInformacion").modal('hide');
                        limpiarOrdenesCompra();
                        $('#btnCobrar').attr("disabled", true);
                        $('#btnRechazar').attr("disabled", true);
                        $('#btnCancelarCobranzas').attr("disabled", true);
                        $("#txtFolioCobrar").val("");
                    }
                    else {
                        alertify.success(resultado);
                    }
                });
            }
        }
    });

    $("#btnCancelarCobranzas").click(function () {
        limpiarOrdenesCompra();
        $('#btnCobrar').attr("disabled", true);
        $('#btnRechazar').attr("disabled", true);
        $('#btnCancelarCobranzas').attr("disabled", true);
        $("#txtFolioCobrar").val("");
        $("#pagarCobranza").hide();
    });



    $("#btnNotasCredito").click(function () {
        $("#mdlnotascredito").modal('show');
    });

    $("#btnPagar").click(function () {
        var datos = parseFloat($("#txtCantidad").val());
        var total = parseFloat($("#totalV").text());
        if (idTipoPago != 2) {
            if (isNaN(datos)) {
                alertify.error("Ingrese solo numeros");
            }
            else {
                if (datos == 0) {
                    alertify.error("Ingrese un valor mayor");
                }
                else if (datos < total) {
                    alertify.error("Ingrese una cantidad mayor");
                }
                else {
                    var folio = $("#xmlComprobante").text();
                    var informacion = "folioComprobante=" + folio + "&idTipoPago=" + idTipoPago + "&importe=" + datos + "&formaPago=0" + "&totalCredito=0";
                    $.get('guardarPagos.php', informacion, function (respuesta) {
                        var callbacks = $.Callbacks();
                        var cambio = datos - total;
                        callbacks.add($('#btnCobrar').attr("disabled", true));
                        callbacks.add($('#btnRechazar').attr("disabled", true));
                        callbacks.add($('#btnCancelarCobranzas').attr("disabled", true));
                        callbacks.add($("#mdlNotacreditoInformacion").modal('hide'));
                        callbacks.add($('#mdlPagar').modal('hide'));
                        callbacks.add($("#txtCantidad").val(""));
                        alertify.alert("<b>Cambio:</b> " + cambio + "", function () {
                            if (respuesta > 0) {
                                callbacks.add(limpiarOrdenesCompra());
                                callbacks.add($("#txtFolioCobrar").val(""));
                                alertify.success("Exito venta concretada");
//                                $(location).attr('href', "generarNotaCompra.php?folio=" + respuesta);
//                                callbacks.add(window.location = "generarNotaCompra.php?folio=" + respuesta, '_blank');
//    
//                                                            window.location = "generarNotaCompra.php?folio=' + respuesta";
                                var status = 0;
                                if (idTipoPago == 2) {
                                    status = 8;
                                }
                                else {
                                    status = 7;
                                }
                                window.open('generarNotaCompra.php?folio=' + respuesta + "&tipo=" + status);
                            }
                        });

                    });
                }
            }
        }
        else {
//            este else nos sirve para guardar la informacion en creditos
            var cambio = datos - total;
            if (datos > total) {
                datos = total;
            }
            var tipoPago = $("#cmbTipoPagoCobranza").val();
            if (tipoPago == 2) {
                alertify.error("Seleccione otro tipo de pago que no sea credito");
            }
            else {
                var folio = $("#xmlComprobante").text();
                var informacion = "folioComprobante=" + folio + "&idTipoPago=" + idTipoPago + "&importe=" + datos + "&formaPago=" + tipoPago + "&totalCredito=" + total;
                $.get('guardarPagos.php', informacion, function (respuesta) {
                    if (respuesta > 0) {
                        alertify.success("Exito venta concretada");
                        var status = 0;
                        if (idTipoPago == 2) {
                            status = 8;
                        }
                        else {
                            status = 7;
                        }
                        window.open('generarNotaCompra.php?folio=' + respuesta + '&tipo=' + status);
                        $("#buscabonos").load("consultarDeudoresPV.php", function () {
                            $('#dtdeudores').dataTable();
                        });
                        limpiarOrdenesCompra();
                        $('#btnCobrar').attr("disabled", true);
                        $('#btnRechazar').attr("disabled", true);
                        $('#btnCancelarCobranzas').attr("disabled", true);
                        $("#mdlNotacreditoInformacion").modal('hide');
                        $('#mdlPagar').modal('hide');
                        $("#txtCantidad").val("");
                        $("#pagarCobranza").hide();
                    }
                });

            }
        }
    });

    $("#btnAbonos").click(function () {
        $("#mdlabonos").modal("show");
    });

});




function cargarInformacion(folio, tipoPago) {
    idTipoPago = tipoPago;
    folioventa = folio;
    $("#informacionPagos").load("dameInformacion.php?id=" + folio, function () {
        $("#mdlBusquedaOrdenCompra").modal("hide");
        $("#btnCobrar").removeAttr('disabled');
        $("#btnRechazar").removeAttr('disabled');
        $("#btnCancelarCobranzas").removeAttr('disabled');
    });
}


function cargarInformacionFolios(folio) {
    folioventa = folio;
    $("#informacionPagos").load("dameInformacion.php?id=" + folio, function (respuesta) {
        if ($.trim(respuesta) != "") {
            $("#btnCobrar").removeAttr('disabled');
            $("#btnRechazar").removeAttr('disabled');
            $('#btnCancelarCobranzas').removeAttr('disabled');
            idTipoPago = $("#lblTipoPago1").text();
        }
        else {
            alertify.alert("<b>No hay información de este folio<b>");
            $("#txtFolioCobrar").val("");
            $('#btnRechazar').attr("disabled", true);
            $('#btnCobrar').attr("disabled", true);
            $('#btnCancelarCobranzas').attr("disabled", true);
        }
    });
}


$("#btnRechazar").click(function () {
    alertify.confirm("¿Esta seguro de eliminar esta orden de compra?", function (e) {
        if (e) {
            var informacion = "idFolio=" + folioventa;
            $.get('rechazarOrdenCompra.php', informacion, function (respuesta) {
                limpiarOrdenesCompra();
                alertify.success(respuesta);
                $('#btnRechazar').attr("disabled", true);
                $('#btnCobrar').attr("disabled", true);
                $('#btnCancelarCobranzas').attr("disabled", true);
                $("#txtFolioCobrar").val("");
            });
        }
    });
});

function limpiarOrdenesCompra() {
    $("#informacionPagos").html("<div id='informacionPagos'></div>");
}