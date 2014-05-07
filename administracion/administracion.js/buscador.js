$(document).ready(function() {
});

$("#btnbuscador").click(function() {
    $("#todos").load("consultarBuscador.php", function() {
        $('#tdProducto').dataTable();
    });
    $('#mdlbuscador').modal('show');
});

function listarProductos() {
    alert("entre");
    var idMarcas = new Array();
    var info;
    $("#tdProducto").find(':checked').each(function() {
        var elemento = this;
        var valor = elemento.value;
        alert(valor);
        idMarcas.push(valor);
        lista = JSON.stringify(idMarcas);
        info = "marcas=" + lista;

    });
    if (info != undefined) {
        alert("Hecho");
//        alertify.confirm("Desea Eliminar las Marcas seleccionadas?", function(e) {
//            if (e) {
//                alertify.success("SI");
//                $.get('eliminaMarca.php', info, function() {
//                    alertify.success("se han dado de baja de manera correcta");
//                    $("#consultaMarca").load("consultarMarca.php", function() {
//                        $('#dtmarca').dataTable();
//                    });
//                });
//            } else {
//                alertify.error("NO");
//            }
//        });
//        return false;

    } else {
        alertify.error("Debes seleccionar al menos una  marca");
    }
}