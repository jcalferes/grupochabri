$(document).ready(function() {
    $("#divabonos").hide();
    $("#slctipopago").load("mostrarTiposPagos.php", function() {
        $("#slctipopago").selectpicker();
    });
});

$("#btnabonos").click(function() {
    $('#mdlabonos').modal('toggle');
});

$("#txtfolioabonos").blur(function() {
    var folio = $("#txtfolioabonos").val();
    var info = "folio=" + folio;
    var pagado = 0
    $.get('consultarDatosAbonos.php', info, function(rs) {
        if (rs != 0) {
            var arr = $.parseJSON(rs);
            $("#nombreabono").text(arr.cliente.nombre);
            $("#rfcabono").text(arr.cliente.rfc);
            $("#creditoabono").text("$" + arr.cliente.credito);
            $("#adeudoabono").text("$" + arr.cliente.totalComprobante);
            $("#tblabonos").load("consultarAbonos.php?folio=" + folio, function() {
                $("#dtabonos").dataTable();
                $("#dtabonos").find('.importeabonos').each(function() {
                    var elemento = this;
                    var valor = elemento.value;
                    pagado = pagado + parseFloat(valor);
                });
                var saldo = arr.cliente.totalComprobante - pagado;
                $("#pagadoabono").text("$" + pagado);
                 $("#saldoabono").text("$" + saldo);
                $("#divabonos").slideDown();
            });
        }
    });
});