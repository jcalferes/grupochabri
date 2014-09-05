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
    $("#cmbCancelaciones").hide();

    $("#slccliente").load("mostrarClientes.php", function() {
        $("#slccliente").selectpicker();
    });
    $("#buscanotascredito").load("consultarNotasCredito.php", function() {
        $('#dtnotascredito').dataTable();
    });
    $("#divfoliocancelacion").hide();

    $("#slccliente").change(function() {
        $("#txtcantidadnotacredito").val("");
        var idCliente = $("#slccliente").val();
        $("#cmbCancelaciones").load("cargarVentasCanceladas.php?idCliente=" + idCliente, function() {
            $("#cmbCancelaciones").slideDown('slow');
        });
    });
    $("#cmbCancelaciones").change(function() {
        var informacion = $("#cmbCancelaciones").val().split(',');
        $("#txtcantidadnotacredito").val(informacion[1]);
    });
});

$("#btnnotascredito").click(function() {
    $('#mdlnotascredito').modal('toggle');
});

$("#btnguardanotacredito").click(function() {
    var idcliente = $("#slccliente").val();
    var datos = $("#cmbCancelaciones").val().split(",");
    var cantidad = $.trim($("#txtcantidadnotacredito").val());
    var foliocancelacion = datos[0];
    if (idcliente == 0) {
        alertify.error("No seleccionaste un cliente");
        return false;
    }

    if (cantidad === "" || cantidad === 0) {
        alertify.error("No agregaste una cantidad");
        $("#txtcantidadnotacredito").val("");
        return false;
    }
    var info = "cantidad=" + cantidad + "&idcliente=" + idcliente + "&foliocancelacion=" + foliocancelacion;
    $.get('guardarNotasCredito.php', info, function(r) {
        if (r == 0) {
            $("#txtfoliocancelacionC").val("");
            $("#divfoliocancelacion").slideUp();
            $("#txtcantidadnotacredito").val("");
            $("#slccliente").selectpicker('val', 0);

            alertify.confirm("Se ha creado/actulizado la nota de credito para el cliente seleccionado. ¿Deseas imprimir la nota de crédito?", function(e) {
                if (e) {
                    window.open('generarNotaCredito.php?idcliente=' + idcliente+'&tipo=7');
                }
            });
            $("#buscanotascredito").load("consultarNotasCredito.php", function() {
                $('#dtnotascredito').dataTable();
            });
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

function vincularcancelacion() {
    var chkfoliocancelacion = $("#chkfoliocancelacion").is(":checked");
    if (chkfoliocancelacion == true) {
        $("#divfoliocancelacion").slideDown();
    } else {
        $("#divfoliocancelacion").slideUp();
    }
}

function imprimirnotacredito(idcliente) {
    window.open('generarNotaCredito.php?idcliente=' + idcliente+"&tipo='7'");
}
