$(document).ready(function() {
    $("#consultaMarca").load("consultarMarca.php", function() {
        $('#dtmarca').dataTable();
    });
    $("#btnguardarMarca").click(function() {
        var nombre = $("#txtnombremarca").val();
        if (nombre == "" || /^\s+$/.test(nombre)) {
            $("#txtnombremarca").val("");
            $("#txtnombremarca").focus();
            alertify.error("El campo no puede estar vacio");
            return false;
        }
        else {
            var info = "nombre=" + nombre;
            $.get('guardaMarca.php', info, function() {
                $("#txtnombremarca").val("");
                $("#selectMarca").load("consultarMarca.php",function(){
                    $("#selectMarca").selectpicker('refresh'); 
                });
                alertify.success("Marca agregada correctamente");
                return false;
            });
        }
    });
});
