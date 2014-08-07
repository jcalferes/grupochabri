var idTipoPago;
var folioventa;

$(document).ready(function() {
    $("#mdlBuscadorOrdenesCompra").click(function() {
        $("#tableOrdenesCompra").load("dameTodasOrdenesCompra.php", function() {
            $("#mdlBusquedaOrdenCompra").modal("show");
        });
    });

    $("#btnCobrar").click(function() {
        if (idTipoPago == 5) {
            var total = $("#totalV").text();
            var rfcCliente = $("#rfcCliente").text();
            $("#informacionNotaCredito").load("dameInformacionNotaCredito.php?total=" + total + "&cliente=" + rfcCliente, function() {
                $("#idClienteNC").hide();
                $("#idNotasCredito").hide();
                $("#mdlNotacreditoInformacion").modal('show');
            });
        }
        else {
            $('#mdlPagar').modal('show');
        }
    });


    $("#btnGuardarNotaCredito").click(function() {
        var idCliente = $("#idClienteNC").text();
        var total = $("#totalDisponibleNotaCredito").text();
        var idNotasCredito = $("#idNotasCredito").text();
        var info = "idCliente=" + idCliente + "&total=" + total + "&idNotasCredito=" + idNotasCredito + "&folioVnta=" + folioventa;
        $.post('guardarNotaCredito.php', info, function(resultado) {
            alertify.success(resultado);
        });
    });




    $("#btnNotasCredito").click(function() {
        $("#mdlnotascredito").modal('show');
    });

    $("#btnPagar").click(function() {
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
                    var informacion = "folioComprobante=" + folio + "&idTipoPago=" + idTipoPago + "&importe=" + datos;
                    $.get('guardarPagos.php', informacion, function(respuesta) {
                        var callbacks = $.Callbacks();
                        callbacks.add(limpiarOrdenesCompra());
                        var cambio = datos - total;
                        callbacks.add($('#btnCobrar').attr("disabled", true));
                        callbacks.add($('#btnRechazar').attr("disabled", true));
                        callbacks.add($("#mdlNotacreditoInformacion").modal('hide'));
                        callbacks.add($('#mdlPagar').modal('hide'));
                        callbacks.add($("#txtCantidad").val(""));
//                        alertify.message("cambio :" + cambio);
                        alertify.success(respuesta);
                    });
                }
            }
        }
        else {
            var cambio = datos - total;
            if (datos > total) {
                datos = total;
            }
            var folio = $("#xmlComprobante").text();
            var informacion = "folioComprobante=" + folio + "&idTipoPago=" + idTipoPago + "&importe=" + datos;
            $.get('guardarPagos.php', informacion, function(respuesta) {
//                alert(cambio);
                $("#buscabonos").load("consultarDeudoresPV.php", function() {
                    $('#dtdeudores').dataTable();
                });
                limpiarOrdenesCompra();
                $('#btnCobrar').attr("disabled", true);
                $('#btnRechazar').attr("disabled", true);
                $("#mdlNotacreditoInformacion").modal('hide');
                $('#mdlPagar').modal('hide');
                $("#txtCantidad").val("");
                alertify.message("cambio :" + cambio);
                alertify.success(respuesta);
            });
//            alert(cambio);
        }

    });

    $("#btnAbonos").click(function() {
        $("#mdlabonos").modal("show");
    });

});




function cargarInformacion(folio, tipoPago) {
    idTipoPago = tipoPago;
    folioventa = folio;
    $("#informacionPagos").load("dameInformacion.php?id=" + folio, function() {
        $("#mdlBusquedaOrdenCompra").modal("hide");
        $("#btnCobrar").removeAttr('disabled');
        $("#btnRechazar").removeAttr('disabled');
    });
}


$("#btnRechazar").click(function() {
    alertify.confirm("¿Esta seguro de eliminar esta orden de compra?", function(e) {
        if (e) {
            var informacion = "idFolio=" + folioventa;
            $.get('rechazarOrdenCompra.php', informacion, function(respuesta) {
                limpiarOrdenesCompra();
                alertify.success(respuesta);
                $('#btnRechazar').attr("disabled", true);
                $('#btnCobrar').attr("disabled", true);
            });
        }
    });
});

function limpiarOrdenesCompra() {
    $("#informacionPagos").html("<div id='informacionPagos'></div>");
}