$(document).ready(function() {

    $("#consultaMarca").load("consultarMarca.php", function() {
        $('#dtmarca').dataTable();
    });
    $("#btnguardarMarca").click(function() {
        var nombre = $.trim($("#txtnombremarca").val().toUpperCase());
        if (nombre == "" || /^\s+$/.test(nombre)) {
            $("#txtnombremarca").val("");
            $("#txtnombremarca").focus();
            alertify.error("El nombre de la marca no puede estar vacío");
            return false;
        }
        else {
            var info = "nombre=" + nombre;
            $.get('guardaMarca.php', info, function(rs) {
                if (rs == 0) {
                    $("#txtnombremarca").val("");
                    $("#selectMarca").load("mostrarMarcas.php", function() {
                        $("#selectMarca").selectpicker('refresh');
                    });
                    $("#consultaMarca").load("consultarMarca.php", function() {
                        $('#dtmarca').dataTable();
                    });
                    $("#txtnombremarca").focus();
                    $("#consultaMarca").load("consultarMarca.php", function() {
                        $('#dtmarca').dataTable();
                    });
                    alertify.success("Marca agregada correctamente");
                }
                if (rs == 999) {
                    $("#selectMarca").load("mostrarMarcas.php", function() {
                        $("#selectMarca").selectpicker('refresh');
                    });
                    alertify.error("Ya existe la marca");
                }

            });
        }
    });
});
