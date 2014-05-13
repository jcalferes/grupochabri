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
    alert(folio);
    $("#tblabonos").load("consultarAbonos.php?folio=" + folio, function() {
        $("#dtabonos").dataTable();
        $("#divabonos").slideDown();
    });
});