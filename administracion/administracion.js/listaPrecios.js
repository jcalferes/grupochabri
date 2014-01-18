$(document).ready(function() {
    $("#btnguardarLista").click(function() {
        var nombrelista = $("#txtnombrelista").val();
        if (nombrelista == "") {
            alertify.error("El campo no puedo estar vacio");
            return false;
        } else {
            var info = "nombrelista=" + nombrelista;
            $.get('guardaListaPrecio.php', info, function() {
                alertify.success("Lista agregada correctamente");
                return false;
            });
        }
    });
});