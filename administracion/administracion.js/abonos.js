$(document).ready(function() {
    alert("Hola");
    $("#slctipopago").load("mostrarTiposPagos.php", function() {
        $("#slctipopago").selectpicker();
    });
});

$("#btnabonos").click(function() {
    $('#mdlabonos').modal('toggle');
});