
function  dameValorDescuento(id) {
    var porcentaje = $("#dct" + id + "").val();
    var info = "id=" + id + "&porcentaje=" + porcentaje;
    $.get('mostrarDescuentos.php', info, function(valor) {
        $("#total" + id + "").val(valor);
    });
}
$(document).ready(function() {
});
