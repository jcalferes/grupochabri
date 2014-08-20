function eliminarMaquinas() {

    var idMaquina = new Array();
    var info;

    $("#dtmaquina").find(':checked').each(function() {
        var elemento = this;
        var valor = elemento.value;
        idMaquina.push(valor);
        lista = JSON.stringify(idMaquina);
        info = "maquinas=" + lista;
    });
//    alert(info);
    if (info != undefined) {
        alertify.confirm("Desea Eliminar las Maquinas seleccionadas?", function(e) {
            if (e) {
                $.get('eliminaMaquinas.php', info, function() {
                    alertify.success("se han dado de baja de manera correcta")
                    $("#consultaMaquina").load("consultarMaquina.php", function() {
                        $('#dtmaquina').dataTable();
                    });
                });
            } else {
            }
        });
        return false;

    } else {
        alertify.error("Debe selecciona al menos una  marca");
    }
}
$(document).ready(function() {
    $("#consultaMaquina").load("consultarMaquina.php", function() {
        $('#dtmaquina').dataTable();
    });
    $("#btnguardarmaquina").click(function() {
        var nombre = $("#txtnombremaquina").val();
        if (nombre == "" || /^\s+$/.test(nombre)) {
            $("#txtnombremaquina").val("");
            $("#txtnombremaquina").focus();
            alertify.error("El campo no puede estar vacio");
            return false;
        }
        else {
            var info = "nombre=" + nombre;
            $.get('guardaMaquina.php', info, function() {
                $("#txtnombremaquina").val("");
//                $("#selectMarca").load("mostrarMarcas.php", function() {
//                    $("#selectMarca").selectpicker('refresh');
//                });
                $("#consultaMaquina").load("consultarMaquina.php", function() {
                    $('#dtmaquina').dataTable();
                });
                alertify.success("Maquina agregada correctamente");
                return false;
            });
        }
    });
});