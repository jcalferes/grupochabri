function eliminarListaPrecios() {

    var idListas = new Array();
    var info;

    $("#dtlistaprecios").find(':checked').each(function() {
        var elemento = this;
        var valor = elemento.value;
        idListas.push(valor);
        lista = JSON.stringify(idListas);
        info = "listaPrecio=" + lista;
    });
    alert(info);
    if (info != undefined) {
        alertify.confirm("Desea Eliminar las listasPrecios seleccionadas?", function(e) {
            if (e) {
                alertify.success("SI");
                $.get('eliminaListaPrecio.php', info, function() {
                    alertify.success("se han dado de baja de manera correcta")
                    $("#consultaListaPrecio").load("consultarListaPrecio.php", function() {
                        $('#dtlistaprecios').dataTable();
                    });
                });
            } else {
                alertify.error("NO");
            }
        });
        return false;

    } else {
        alertify.error("Debe selecciona al menos una  listaPrecio");
    }
}
$(document).ready(function() {
    $("#consultaListaPrecio").load("consultarListaPrecio.php", function() {
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