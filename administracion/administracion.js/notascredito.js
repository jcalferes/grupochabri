//============ UTILIDADES ======================================================
function NumCheck2(e, field, tarifa) {
    key = e.keyCode ? e.keyCode : e.which
    if (key == 15)
        return true
    if (key > 47 && key < 58) {
        if (field.value == "")
            return true
        regexp = /.[0-9]{20}$/
        return !(regexp.test(field.value))
    }
    if (key == 46) {
        if (field.value == "")
            return false
        regexp = /^[0-9]+$/
        return regexp.test(field.value)
    }
    return false
}

//=========== TERMINA UTILIDADES ===============================================

$(document).ready(function() {
    $("#slccliente").load("mostrarClientes.php", function() {
        $("#slccliente").selectpicker();
    });
});

$("#btnnotascredito").click(function() {
    $('#mdlnotascredito').modal('toggle');
});