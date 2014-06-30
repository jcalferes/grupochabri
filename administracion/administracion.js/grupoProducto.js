$(document).ready(function() {
    $("#btnGuardarGrupo").click(function() {
        var nombreGrupo = $("#txtnombreGrupo").val().toUpperCase();
        var info = "nombreGrupo=" + nombreGrupo;
        $.get('guardarGrupo.php', info, function(status) {
            if (status == 0) {
                $("#selectGrupo").load("mostrarGrupos.php", function() {
                    $("#selectGrupo").selectpicker('refresh');
                });
                alertify.success("Se guardo el grupo exitosamente");
                $("#txtnombreGrupo").val("");
            }
            if (status == 999) {
                $("#selectGrupo").load("mostrarGrupos.php", function() {
                    $("#selectGrupo").selectpicker('refresh');
                });
                $("#txtnombreGrupo").val("");
                alertify.error("Ya existe el grupo");
            }

        });
    });

});
