var ids = new Array();
var dcts = new Array();
function  dameValorId(id) {
    var info = $("#id" + id + "").val();
    alert(info);
    ids[id] = info;
}
function  dameValorDescuento(id) {
    var porcentaje = $("#dct" + id + "").val();
//    $("#total" + id + "").load("mostrarDescuentos.php?id=" + id+"&porcentaje="+porcentaje, function() {
//        alert("info");
//    });
    var info = "id=" + id + "&porcentaje=" + porcentaje;
    $.get('mostrarDescuentos.php', info, function(valor) {
        $("#total"+id+"").val(valor);
    });
//    $("#hola").load("mostrarDescuentos.php?id=" + id + "&porcentaje=" + porcentaje, function() {
//
//    });


//    dcts[id] = info;
}
$(document).ready(function() {
});
