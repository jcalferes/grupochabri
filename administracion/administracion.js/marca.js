function eliminarMarcas() {
    var idMarcas = new Array();
    var info;
    $("#dtmarca").find(':checked').each(function() {
        var elemento = this;
        var valor = elemento.value;
        idMarcas.push(valor);
        lista = JSON.stringify(idMarcas);
        info = "marcas=" + lista;

    });
    if (info != undefined) {
        alertify.confirm("Desea Eliminar las Marcas seleccionadas?", function(e) {
            if (e) {
                alertify.success("SI");
                $.get('eliminaMarca.php', info, function() {
                    alertify.success("se han dado de baja de manera correcta");
                    $("#consultaMarca").load("consultarMarca.php", function() {
                        $('#dtmarca').dataTable();
                    });
                });
            } else {
                alertify.error("NO");
            }
        });
        return false;

    } else {
        alertify.error("Debe selecciona al menos una  marca");
    }
}

$(document).ready(function() {

    $("#consultaMarca").load("consultarMarca.php", function() {
        $('#dtmarca').dataTable();
    });
    $("#btnguardarMarca").click(function() {
        var nombre = $.trim($("#txtnombremarca").val().toUpperCase());
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
                $("#selectMarca").load("mostrarMarcas.php", function() {
                    $("#selectMarca").selectpicker('refresh');
                });
                $("#consultaMarca").load("consultarMarca.php", function() {
                    $('#dtmarca').dataTable();
                });
                $("#txtnombremarca").focus();
                alertify.success("Marca agregada correctamente");
                return false;
            });
        }
    });
});
