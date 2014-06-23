//============ UTILIDADES ======================================================
function NumCheck2(e, field, tarifa) {
    key = e.keyCode ? e.keyCode : e.which
    if (key == 15)
        return true
    if (key > 47 && key < 58) {
        if (field.value == "")
            return true;
        regexp = /.[0-9]{20}$/
        return !(regexp.test(field.value))
    }
    if (key == 46) {
        if (field.value == "")
            return false;
        regexp = /^[0-9]+$/
        return regexp.test(field.value)
    }
    return false;
}
//=========== TERMINA UTILIDADES ===============================================

$(document).ready(function() {
    $("#nuevanotacredito").hide();
    $("#slccliente").load("mostrarClientes.php", function() {
        $("#slccliente").selectpicker();
    });
});

$("#btnnotascredito").click(function() {
    $('#mdlnotascredito').modal('toggle');
});

$("#btnguardanotacredito").click(function() {
    var cantidad = $("#txtcantidadnotacredito").val();
    var idcliente = $("#slccliente").val();
    if (idcliente == 0) {
        alertify.error("No seleccionaste un cliente");
        return false;
    }
    if (cantidad === "" || /^\s+$/.test(cantidad)) {
        alertify.error("No agregaste una cantidad");
        $("#txtcantidadnotacredito").val("");
        return false;
    }
    var info = "cantidad=" + cantidad + "&idcliente=" + idcliente;
    $.get('guardarNotasCredito.php', info, function(r) {
        if (r == 0) {
            alertify.success("Se ha creado/actulizado la nota de credito para el cliente seleccionado");
            $("#txtcantidadnotacredito").val("");
            $("#slccliente").selectpicker('val', 0);
        }
        if (r == 1) {
            alertify.error("No se pudo completar el proceso");
        }
    });
});

$("#btnnuevanotacredito").click(function() {
    $("#vernotascredito").slideUp();
    $("#nuevanotacredito").slideDown();
});

$("#btncancelarnotacredito").click(function() {
    $("#vernotascredito").slideDown();
    $("#nuevanotacredito").slideUp();
    $("#txtcantidadnotacredito").val("");
    $("#slccliente").selectpicker('val', 0);
});