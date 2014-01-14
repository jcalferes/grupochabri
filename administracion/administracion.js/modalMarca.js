$(document).ready(function() {
//    alert('Entre a JSMarca');
    $("#btnguardarMarca").click(function() {
        var nombre = $("#txtnombremarca").val();
        if (nombre == "") {
            alertify.error("El campo no puede estar vacio");
            return false;
        }
        else {
            var info = "nombre=" + nombre;
            $.get('guardaMarca.php', info, function() {
                try {
                    $("#selectMarca").load("mostrarMarcas.php");
                }
                catch (e) {
                    alert();
                }
                $('#selectMarca').load('mostarMarcas.php');
                alertify.success("Marca agregada correctamente");
            });
        }
    });
    $("#canceloMarca").click(function() {
        $("#ejecutaMdlProducto").trigger("click");
    });
    $("#btnguardarMarca").click(function() {
        $("#ejecutaMdlProducto").trigger("click");
    });
});
