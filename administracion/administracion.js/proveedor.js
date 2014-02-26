function verDireccion(id) {
    var info = "id=" + id;
    $("#verdireccion").load("consultaDireccion.php", info, function() {
    });
}
function focusRFC() {
    $("#txtrfc").focus();
}
function validaRfc() {
    var rfc = $("#txtrfc").val().toUpperCase();
    if (rfc === "" || /^\s+$/.test(rfc)) {
        $("#frmrfc").removeClass("has-success");
        $("#frmrfc").removeClass("has-error");
    } else {
        var fisica = $("#fisica").is(":checked");
        var moral = $("#moral").is(":checked");
        if (fisica == true) {
            if ($("#txtrfc").val().toUpperCase().match(/^[A-Z]{4}[ \-]?[0-9]{2}((0{1}[1-9]{1})|(1{1}[0-2]{1}))((0{1}[1-9]{1})|([1-2]{1}[0-9]{1})|(3{1}[0-1]{1}))[ \-]?[A-Z0-9]{3}$/)) {
                $("#frmrfc").removeClass("has-error");
                $("#frmrfc").addClass("has-success");
            } else {
                $("#frmrfc").removeClass("has-success");
                $("#frmrfc").addClass("has-error");
                $("#txtrfc").focus();
            }
        }
        if (moral == true) {
            if ($("#txtrfc").val().toUpperCase().match(/^[A-Z]{3}[ \-]?[0-9]{2}((0{1}[1-9]{1})|(1{1}[0-2]{1}))((0{1}[1-9]{1})|([1-2]{1}[0-9]{1})|(3{1}[0-1]{1}))[ \-]?[A-Z0-9]{3}$/)) {
                $("#frmrfc").removeClass("has-error");
                $("#frmrfc").addClass("has-success");
            } else {
                $("#frmrfc").removeClass("has-success");
                $("#frmrfc").addClass("has-error");
                $("#txtrfc").focus();
            }
        }
    }
}

function validaEmail() {
    var rfc = $("#txtemail").val();
    if (rfc === "" || /^\s+$/.test(rfc)) {
        $("#frmemail").removeClass("has-success");
        $("#frmemail").removeClass("has-error");
    } else {
        if ($("#txtemail").val().match(/^[a-zA-Z0-9\._-]+@[a-zA-Z0-9-]{2,}[.][a-zA-Z]{2,4}$/)) {
            $("#frmemail").removeClass("has-error");
            $("#frmemail").addClass("has-success");
        } else {
            $("#frmemail").removeClass("has-success");
            $("#frmemail").addClass("has-error");
            $("#txtemail").focus();
        }
    }
}

$(document).ready(function() {
    $("#consultaProveedor").load("consultarProveedor.php", function() {
        $('#dtproveedor').dataTable();
    });

    $(function() {
        $('#txtrfc').validCampoFranz('0123456789abcdefghijklmnñopqrstuvwxyzáéiou');
        $('#txtdiascredito').validCampoFranz('0123456789');
        $('#txtdesctpf').validCampoFranz('0123456789');
        $('#txtdesctpp').validCampoFranz('0123456789');
        $("#txtnombreproveedor").validCampoFranz('0123456789abcdefghijklmnñopqrstuvwxyzáéiou ');
    });

    $("#btncanceloProvedor").click(function() {
        $("#txtnombreproveedor").val("");
        $("#txtrfc").val("");
        $("#txtdiascredito").val("");
        $("#txtdescuento").val("");
        $("#formulario").show("slow");
        $("#mostrarDivProveedor").hide("slow");

    });
    $("#btnguardarproveedor").click(function() {
        var nombre = $.trim($("#txtnombreproveedor").val().toUpperCase());
        var rfc = $("#txtrfc").val().toUpperCase();
        var diascredito = $("#txtdiascredito").val();
        var descuento = $("#txtdescuento").val();
        var email = $("#txtemail").val();
        var desctpf = $("#txtdesctpf").val();
        var desctpp = $("#txtdesctpp").val();

        if (nombre == "" || /^\s+$/.test(nombre) || rfc == "" || /^\s+$/.test(rfc) || diascredito == "" || /^\s+$/.test(diascredito) || descuento == "" || /^\s+$/.test(descuento) || email == "" || /^\s+$/.test(email)) {
            alertify.error("Todos los campos son obligatorios");
            return false;
        }

        var fisica = $("#fisica").is(":checked");
        var moral = $("#moral").is(":checked");
        if (fisica == true) {
            if ($("#txtrfc").val().toUpperCase().match(/^[A-Z]{4}[ \-]?[0-9]{2}((0{1}[1-9]{1})|(1{1}[0-2]{1}))((0{1}[1-9]{1})|([1-2]{1}[0-9]{1})|(3{1}[0-1]{1}))[ \-]?[A-Z0-9]{3}$/)) {
                $("#frmrfc").removeClass("has-error");
                $("#frmrfc").addClass("has-success");
            } else {
                $("#frmrfc").removeClass("has-success");
                $("#frmrfc").addClass("has-error");
                $("#txtrfc").focus();
                alertify.error("RFC no valido para personas fisicas");
                return false;
            }
        }
        if (moral == true) {
            if ($("#txtrfc").val().toUpperCase().match(/^[A-Z]{3}[ \-]?[0-9]{2}((0{1}[1-9]{1})|(1{1}[0-2]{1}))((0{1}[1-9]{1})|([1-2]{1}[0-9]{1})|(3{1}[0-1]{1}))[ \-]?[A-Z0-9]{3}$/)) {
                $("#frmrfc").removeClass("has-error");
                $("#frmrfc").addClass("has-success");
            } else {
                $("#frmrfc").removeClass("has-success");
                $("#frmrfc").addClass("has-error");
                $("#txtrfc").focus();
                alertify.error("RFC no valido para personas morales");
                return false;
            }
        }

        var info = "nombre=" + nombre + "&rfc=" + rfc + "&diascredito=" + diascredito + "&desctpf=" + desctpf + "&desctpp=" + desctpp + "&email=" + email;
        $.get('guardaProveedor.php', info, function(respuesta) {
            var info = respuesta;
            if (info == 2)
            {
                alertify.error("RFC no valido");
                return false;
            }
            if (info == 3)
            {
                alertify.error("Error al gurdar direccion");
                return false;
            }
            if (info == 1)
            {
                alertify.error("No agregaste una direccion");
                return false;
            } else {
                $("#txtdesctpf").val("");
                $("#txtdesctpp").val("");
                $("#txtnombreproveedor").val("");
                $("#txtrfc").val("");
                $("#txtemail").val("");
                $("#txtdiascredito").val("");
                $("#txtdescuento").val("");
                $("#formulario").show("slow");
                $("#mostrarDivProveedor").hide("slow");
                $("#frmrfc").removeClass("has-success");
                $("#frmrfc").removeClass("has-error");
                $("#frmemail").removeClass("has-success");
                $("#frmemail").removeClass("has-error");
                $("#consultaProveedor").load("consultarProveedor.php", function() {
                    $('#dtproveedor').dataTable();
                });
                $("#selectProveedor").load("mostrarProveedores.php", function() {
                    $("#selectProveedor").selectpicker('refresh');
                });
                alertify.success("Proveedor agregado correctamente");
                return false;
            }
        });

    });
});


