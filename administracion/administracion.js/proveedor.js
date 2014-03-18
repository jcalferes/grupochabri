var cuantostel = 0;
var cuantosemail = 0;
var txttel = "mastel";
var txtemail = "masemail";

$("#btnotrotel").click(function() {
    cuantostel++;
    cadena = txttel + cuantostel;
    $("#frmtel").append("<div id=" + cadena + " class=\"input-group\" style=\"margin-top: 10px; width: 50%;\" ><input type=\"text\" class=\"telefono form-control\"><span class=\"input-group-btn\"><button class=\"btn\" onclick='borratel(\"" + cadena + "\")' type=\"button\"><span class=\"glyphicon glyphicon-remove\"></span></button></span></div>");
    recon();

});

function recon() {
    $(".telefono").validCampoFranz('0123456789');
    $(".email").validCampoFranz('0123456789');
}

$("#btnotroemail").click(function() {
    cuantosemail++;
    cadena = txtemail + cuantosemail;
    $("#frmemail").append("<div id=" + cadena + " class=\"input-group\" style=\"margin-top: 10px; width: 50%;\"><input type=\"text\" class=\"form-control\"><span class=\"input-group-btn\"><button class=\"btn\" onclick='borraemail(\"" + cadena + "\")' type=\"button\"><span class=\"glyphicon glyphicon-remove\"></span></button></span></div>");
});

function borratel(cadena) {
    $("#" + cadena).remove();
}

function borraemail(cadena) {
    $("#" + cadena).remove();
}

function eliminarProveedores() {
    var idProveedor = new Array();
    var info;

    $("#dtproveedor").find(':checked').each(function() {
        var elemento = this;
        var valor = elemento.value;
        idProveedor.push(valor);
        lista = JSON.stringify(idProveedor);
        info = "proveedor=" + lista;
    });
//    alert(info);
    if (info != undefined) {
        alertify.confirm("Desea Eliminar los proveedores seleccionadas?", function(e) {
            if (e) {
                $.get('eliminaProveedor.php', info, function() {
                    alertify.success("se han dado de baja de manera correcta")
                    $("#consultaProveedor").load("consultarProveedor.php", function() {
                        $('#dtProveedor').dataTable();
                    });
                });
            } else {
            }
        });
        return false;
    } else {
        alertify.error("Debe selecciona al menos un proveedor");
    }
}

function verficaPostal2() {
    $("#txtestado").val("");
    $("#txtciudad").val("");
    $("#selectColonia").removeAttr("disabled", "disabled");
    var postal = $("#txtpostal").val();
    if (postal == "" || /^\s+$/.test(postal)) {
    }
    else {
        var info = "postal=" + postal;
        $.get('obtieneDireccion.php', info, function(respuesta) {
            var dataJson = eval(respuesta);
            $("#selectColonia").html(function() {
                var contenido;
                contenido = "<select id='selectColonia'>";
                for (var i in dataJson) {
                    contenido += "<option value='" + dataJson[i].idcpostales + "'>" + dataJson[i].asenta + "</option>";
                    $("#txtciudad").val(dataJson[i].ciudad);
                    $("#txtestado").val(dataJson[i].estado);
                }
                contenido += "</select>";
                return contenido;
            });
            $("#btneditardireccion").trigger("click");
        });
    }
}

function verDireccion(id) {
    var info = "id=" + id;
    $("#verdireccion").load("consultaDireccion.php", info, function() {
        $('#mdlverdireccion').modal('show');
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
    var mail = $("#txtemail").val();
    if (mail === "" || /^\s+$/.test(mail)) {
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

    $(":input:first").focus();

    $("#botonNinja").hide();
    $("#btneditardireccion").hide();
    $("#btneditarproveedor").hide();
    $("#consultaProveedor").load("consultarProveedor.php", function() {
        $('#dtproveedor').dataTable();
    });

    $(function() {
        $(".telefono").validCampoFranz('0123456789');
        $(".email").validCampoFranz('0123456789');
        $('#txtrfc').validCampoFranz('0123456789abcdefghijklmnñopqrstuvwxyzáéiou.');
        $('#txtdiascredito').validCampoFranz('0123456789');
        $('#txtdesctpf').validCampoFranz('0123456789');
        $('#txtdesctpp').validCampoFranz('0123456789');
        $("#txtnombreproveedor").validCampoFranz('0123456789abcdefghijklmnñopqrstuvwxyzáéiou. ');
        $('#txtemail').validCampoFranz('abcdefghijklmnñopqrstuvwxyz1234567890<>@,;.:-_^{[}]+¿¡?=)(/&%$#"!|°');
    });


    $("#btncanceloProvedor").click(function() {
        $("#txtnombreproveedor").val("");
        $("#txtrfc").val("");
        $("#txtdiascredito").val("");
        $("#txtdescuento").val("");
        $("#formulario").show("slow");
        $("#mostrarDivProveedor").hide("slow");

    });
//==============================================================================
    $("#btnguardarproveedor").click(function() {
        var nombre = $.trim($("#txtnombreproveedor").val().toUpperCase());
        var rfc = $("#txtrfc").val().toUpperCase();
        var diascredito = $("#txtdiascredito").val();
        var descuento = $("#txtdescuento").val();
        var email = $("#txtemail").val();
        var desctpf = $("#txtdesctpf").val();
        var desctpp = $("#txtdesctpp").val();
        var radios;

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
                radios = $("#fisica").val();
            } else {
                $("#frmrfc").removeClass("has-success");
                $("#frmrfc").addClass("has-error");
                $("#txtrfc").focus();
                alertify.error("RFC no valido para personas fisicas");
                radios = $("#fisica").val();
                return false;
            }
        }
        if (moral == true) {
            if ($("#txtrfc").val().toUpperCase().match(/^[A-Z]{3}[ \-]?[0-9]{2}((0{1}[1-9]{1})|(1{1}[0-2]{1}))((0{1}[1-9]{1})|([1-2]{1}[0-9]{1})|(3{1}[0-1]{1}))[ \-]?[A-Z0-9]{3}$/)) {
                $("#frmrfc").removeClass("has-error");
                $("#frmrfc").addClass("has-success");
                radios = $("#moral").val();
            } else {
                $("#frmrfc").removeClass("has-success");
                $("#frmrfc").addClass("has-error");
                $("#txtrfc").focus();
                alertify.error("RFC no valido para personas morales");
                radios = $("#moral").val();
                return false;
            }
        }

        var info = "nombre=" + nombre + "&rfc=" + rfc + "&diascredito=" + diascredito + "&desctpf=" + desctpf + "&desctpp=" + desctpp + "&email=" + email + "&radios=" + radios;
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
                $(".direccion").val("");

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
                $("#txtrfc").focus();
                alertify.success("Proveedor agregado correctamente");
                return false;
            }
        });

    });

//==============================================================================
    $("#btneditarproveedor").click(function() {
        var nombre = $.trim($("#txtnombreproveedor").val().toUpperCase());
        var rfc = $("#txtrfc").val().toUpperCase();
        var diascredito = $("#txtdiascredito").val();
        var descuento = $("#txtdescuento").val();
        var email = $("#txtemail").val();
        var desctpf = $("#txtdesctpf").val();
        var desctpp = $("#txtdesctpp").val();
        var radios;

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
                radios = $("#fisica").val();
            } else {
                $("#frmrfc").removeClass("has-success");
                $("#frmrfc").addClass("has-error");
                $("#txtrfc").focus();
                alertify.error("RFC no valido para personas fisicas");
                radios = $("#fisica").val();
                return false;
            }
        }
        if (moral == true) {
            if ($("#txtrfc").val().toUpperCase().match(/^[A-Z]{3}[ \-]?[0-9]{2}((0{1}[1-9]{1})|(1{1}[0-2]{1}))((0{1}[1-9]{1})|([1-2]{1}[0-9]{1})|(3{1}[0-1]{1}))[ \-]?[A-Z0-9]{3}$/)) {
                $("#frmrfc").removeClass("has-error");
                $("#frmrfc").addClass("has-success");
                radios = $("#moral").val();
            } else {
                $("#frmrfc").removeClass("has-success");
                $("#frmrfc").addClass("has-error");
                $("#txtrfc").focus();
                alertify.error("RFC no valido para personas morales");
                radios = $("#moral").val();

                return false;
            }
        }

        var info = "nombre=" + nombre + "&rfc=" + rfc + "&diascredito=" + diascredito + "&desctpf=" + desctpf + "&desctpp=" + desctpp + "&email=" + email + "&radios=" + radios;
        $.get('editarProveedor.php', info, function(respuesta) {
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
                $(".direccion").val("");

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
                alertify.success("Proveedor editado correctamente");
                return false;
            }
        });

    });
//==============================================================================
    $("#txtrfc").keyup(function() {
        var rfc = $("#txtrfc").val();
        var info = "rfc=" + rfc;
        $.get('verificandoProvedor.php', info, function(x) {
            if (x == 1) {
                $("#btneditardireccion").hide();
                $("#btnguardardireccion").show();
                $("#btneditarproveedor").hide();
                $("#btnguardarproveedor").show();
                $("#txtdesctpf").val("");
                $("#txtdesctpp").val("");
                $("#txtnombreproveedor").val("");
                $("#txtemail").val("");
                $("#txtdiascredito").val("");
                $("#txtdescuento").val("");
                $(".direccion").val("");
                $.get('borrarVariable.php');
            } else {
                $("#btneditardireccion").show();
                $("#btnguardardireccion").hide();
                $("#btneditarproveedor").show();
                $("#btnguardarproveedor").hide();

                lista = JSON.parse(x);
                console.log(lista);
                $("#botonNinja").trigger("click");

                $.each(lista, function(ind, elem) {
                    if (ind == "tipoProveedor") {
                        if (elem == "FISICA") {
                            $("#fisica").prop("checked", true);
//                            $("#moral").attr("checked", false);
                        }
                        if (elem == "MORAL") {
                            $("#moral").prop("checked", true);
//                            $("#fisica").attr("checked", false);
                        }
                    }
                    if (ind == "nombre") {
                        $("#txtnombreproveedor").val(elem);
                    }
                    if (ind == "email") {
                        $("#txtemail").val(elem);
                    }
                    if (ind == "diasCredito") {
                        $("#txtdiascredito").val(elem);
                    }
                    if (ind == "descuentoPorFactura") {
                        $("#txtdesctpf").val(elem);
                    }
                    if (ind == "descuentoPorProntoPago") {
                        $("#txtdesctpp").val(elem);
                    }
                    if (ind == "calle") {
                        $("#txtcalle").val(elem);
                    }
                    if (ind == "numeroExterior") {
                        $("#txtnumeroexterior").val(elem);
                    }
                    if (ind == "numeroExterior") {
                        $("#txtnumerointerior").val(elem);
                    }
                    if (ind == "cruzamientos") {
                        $("#txtcruzamientos").val(elem);
                    }
                    if (ind == "cp") {
                        $("#txtpostal").val(elem);

                    }
                    if (ind == "idDireccion") {
                        $("#extra").val(elem);

                    }



//                    if (ind == "32") {
//                        $("#txtciudad").val(elem);
//                    }
//                    if (ind == "34") {
//                        $("#txtestado").val(elem);
//                    }
//                    if (ind == "30") {
//                        
//                        $("#selectcolonia").val(elem);
//                    }
                });

            }
//            $("#btnguardardireccion").trigger("click");
        });

    });


});


