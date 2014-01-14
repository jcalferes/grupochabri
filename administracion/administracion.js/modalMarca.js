$(document).ready(function() {
    $("#btnguardar").click(function() {
        var nombre = $("#txtnombremarca").val();
        if (nombre == "") {
            alertify.error("El campo no puede estar vacio");
            return false;
        }
        else {
            var info = "nombre=" + nombre;
            $.get('guardaMarca.php', info, function() {
                $('#selectMarca').load('mostarMarcas.php')
                alertify.success("Marca agregada correctamente");
            });
        }
    });
});
