var idTipoPago;

$(document).ready(function() {
    $("#mdlBuscadorOrdenesCompra").click(function() {
        $("#tableOrdenesCompra").load("dameTodasOrdenesCompra.php", function() {
            $("#mdlBusquedaOrdenCompra").modal("show");
        });
    });

    $("#btnCobrar").click(function() {
        $('#mdlPagar').modal('show');
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
                    var informacion = "folioComprobante=" + folio + "&idTipoPago=" + idTipoPago;
                    $.get('guardarPagos.php', informacion, function(respuesta) {
                        alertify.success(respuesta);
                        var cambio = datos - total;
                        alert(cambio);
                    });
                }
            }
        }
        else {
            var folio = $("#xmlComprobante").text();
            var informacion = "folioComprobante=" + folio + "&idTipoPago=" + idTipoPago;
            $.get('guardarPagos.php', informacion, function(respuesta) {
                alertify.success(respuesta);
                var cambio = datos - total;
                alert(cambio);
            });
        }
    });

    $("#btnAbonos").click(function() {
        $("#mdlabonos").modal("show");
    });

});

function cargarInformacion(folio, tipoPago) {
    idTipoPago = tipoPago;
    $("#informacionPagos").load("dameInformacion.php?id=" + folio, function() {
        $("#mdlBusquedaOrdenCompra").modal("hide");
    });
}