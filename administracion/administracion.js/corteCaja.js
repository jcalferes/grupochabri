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

});


