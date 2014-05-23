$(document).ready(function() {
    $("#btnGuardarGrupo").click(function() {
        var nombreGrupo = $("#txtnombreGrupo").val().toUpperCase();
        var info = "nombreGrupo=" + nombreGrupo;
        $.get('guardarGrupo.php', info, function(status) {
            alert(status);
            if (status == "OK") {
             
                $("#selectGrupo").load("mostrarGrupos.php",function(){
                    $("#selectGrupo").selectpicker('refresh');
                });
                alertify.success("se guardo el grupo exitosamente");
                $("#txtnombreGrupo").val("");
            } else {
                alertify.error("no guardo");
            }
        });
    });

});
