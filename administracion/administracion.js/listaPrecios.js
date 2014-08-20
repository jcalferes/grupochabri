$(document).ready(function() {
    $("#consultaListaPrecio").load("consultarListaprecio.php", function() {
        $('#dtlistaprecios').dataTable();
    });
});

$("#btnguardarLista").click(function() {
    var nombrelista = $.trim($("#txtnombrelista").val().toUpperCase());
    if (nombrelista == "" || /^\s+$/.test(nombrelista)) {
        $("#txtnombrelista").val("");
        $("#txtnombrelista").focus();
        alertify.error("El nombre de la lista de precio no puede estar vacío");
        return false;
    } else {
        var info = "nombrelista=" + nombrelista;
        $.get('guardaListaPrecio.php', info, function(respuesta) {
            var control = respuesta;
            if (control == 999) {
                alertify.error("Ya existe esta lista precio");
                return false;
            }
            if (control == 0) {
                alertify.error("Error al guardar");
                return false;
            }
            if (control == 1) {
                $("#consultaListaPrecio").load("consultarListaPrecio.php");
                $("#txtnombrelista").val("");
                $("#txtnombrelista").focus();
                alertify.success("Lista agregada correctamente");
                return false;
            }
        });
    }
});