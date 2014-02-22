$(document).ready(function() {
    $("#consultaListaPrecio").load("consultarListaPrecio.php", function(){
        $('#dtlistaprecios').dataTable();
    });
    $("#btnguardarLista").click(function() {
        var nombrelista = $("#txtnombrelista").val();
        if (nombrelista == "" || /^\s+$/.test(nombrelista)) {
            $("#txtnombrelista").val("");
            $("#txtnombrelista").focus();
            alertify.error("El campo no puede estar vacio");
            return false;
        } else {
            var info = "nombrelista=" + nombrelista;
            $.get('guardaListaPrecio.php', info, function(respuesta) {
                var control = respuesta;
                if (control == 0) {
                    alertify.error("Error al guardar");
                    return false;
                }
                if (control == 1) {
                    $("#consultaListaPrecio").load("consultarListaPrecio.php");
                    $("#txtnombrelista").val("");
                    alertify.success("Lista agregada correctamente");
                    return false;
                }
            });
        }
    });


});