var cuantostel = 0;
var cuantosemail = 0;
var txttel = "mastel";
var txtemail = "masemail";

function Proveedor(nombre, rfc, diascredito, desctpf, desctpp, radios) {
    this.nombre = nombre;
    this.rfc = rfc;
    this.diascredito = diascredito;
    this.desctpf = desctpf;
    this.desctpp = desctpp;
    this.radios = radios;
}

function Direccion(calle, numeroexterior, numerointerior, cruzamientos, postal, colonia, ciudad, estado) {
    this.calle = calle;
    this.numeroexterior = numeroexterior;
    this.numerointerior = numerointerior;
    this.cruzamientos = cruzamientos;
    this.postal = postal;
    this.colonia = colonia;
    this.estado = estado;
    this.ciudad = ciudad;
}

$("#btnotrotel").click(function() {
    cuantostel++;
    cadena = txttel + cuantostel;
    $("#frmtel").append("<div id=" + cadena + " class=\"input-group\" style=\"margin-top: 10px; width: 62%;\" ><input type=\"text\" class=\"telefono form-control\"><span class=\"input-group-btn\"/><button class=\"btn\" onclick='borratel(\"" + cadena + "\")' type=\"button\"><span class=\"glyphicon glyphicon-remove\"></span></button></div>");
    aplicarValidacion();

});

function aplicarValidacion() {
    $(".telefono").validCampoFranz('0123456789');
    $(".email").validCampoFranz('abcdefghijklmnñopqrstuvwxyz1234567890<>@,;.:-_^{[}]+¿¡?=)(/&%$#"!|°');
}

$("#btnotroemail").click(function() {
    cuantosemail++;
    cadena = txtemail + cuantosemail;
    $("#frmemail").append("<div id=" + cadena + " class=\"input-group\" style=\"margin-top: 10px; width: 62%;\" ><input type=\"text\" class=\"email form-control\"><span class=\"input-group-btn\"/><button class=\"btn\" onclick='borratel(\"" + cadena + "\")' type=\"button\"><span class=\"glyphicon glyphicon-remove\"></span></button></div>");
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
                for (var i in dataJson) {
                    contenido += "<option value='" + dataJson[i].asenta + "'>" + dataJson[i].asenta + "</option>";

                }
                alert(contenido);
                return contenido;
            });
            $("#btneditardireccionproveedor").trigger("click");
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

//function validaEmail() {
//    var mail = $("#txtemail").val();
//    if (mail === "" || /^\s+$/.test(mail)) {
//        $("#frmemail").removeClass("has-success");
//        $("#frmemail").removeClass("has-error");
//    } else {
//        if ($("#txtemail").val().match(/^[a-zA-Z0-9\._-]+@[a-zA-Z0-9-]{2,}[.][a-zA-Z]{2,4}$/)) {
//            $("#frmemail").removeClass("has-error");
//            $("#frmemail").addClass("has-success");
//        } else {
//            $("#frmemail").removeClass("has-success");
//            $("#frmemail").addClass("has-error");
//            $("#txtemail").focus();
//        }
//    }
//}


$(document).ready(function() {
    $(":input:first").focus();
    $("#botonNinja").hide();
    $("#btneditardireccionproveedor").hide();
    $("#btneditarproveedor").hide();
    $("#consultaProveedor").load("consultarProveedor.php", function() {
        $('#dtproveedor').dataTable();
    });

    $(function() {
        $(".telefono").validCampoFranz('0123456789');
        $(".email").validCampoFranz('abcdefghijklmnñopqrstuvwxyz1234567890<>@,;.:-_^{[}]+¿¡?=)(/&%$#"!|°');
        $('#txtrfc').validCampoFranz('0123456789abcdefghijklmnñopqrstuvwxyzáéiou.');
        $('#txtdiascredito').validCampoFranz('0123456789');
        $('#txtdesctpf').validCampoFranz('0123456789');
        $('#txtdesctpp').validCampoFranz('0123456789');
        $("#txtnombreproveedor").validCampoFranz('0123456789abcdefghijklmnñopqrstuvwxyzáéiou. ');
        $('#txtemail').validCampoFranz('abcdefghijklmnñopqrstuvwxyz1234567890<>@,;.:-_^{[}]+¿¡?=)(/&%$#"!|°');
        $("#txtestado").validCampoFranz('abcdefghijklmnñopqrstuvwxyz');
        $("#BuscarCodigo").validCampoFranz('abcdefghijklmnñopqrstuvwxyz');
        $("#txtciudad").validCampoFranz('abcdefghijklmnñopqrstuvwxyz');
    });

    $("#btncanceloProvedor").click(function() {
        $("#txtnombreproveedor").val("");
        $("#txtrfc").val("");
        $("#txtdiascredito").val("");
        $("#txtdescuento").val("");
        $("#formulario").show("slow");
        $("#mostrarDivProveedor").hide("slow");

    });

    $("#btneditarproveedor").click(function() {
        alertify.alert("No es posible editar por el momento...");
//        var nombre = $.trim($("#txtnombreproveedor").val().toUpperCase());
//        var rfc = $("#txtrfc").val().toUpperCase();
//        var diascredito = $("#txtdiascredito").val();
//        var descuento = $("#txtdescuento").val();
//        var email = $("#txtemail").val();
//        var desctpf = $("#txtdesctpf").val();
//        var desctpp = $("#txtdesctpp").val();
//        var radios;
//
//        if (nombre == "" || /^\s+$/.test(nombre) || rfc == "" || /^\s+$/.test(rfc) || diascredito == "" || /^\s+$/.test(diascredito) || descuento == "" || /^\s+$/.test(descuento) || email == "" || /^\s+$/.test(email)) {
//            alertify.error("Todos los campos son obligatorios");
//            return false;
//        }
//
//        var fisica = $("#fisica").is(":checked");
//        var moral = $("#moral").is(":checked");
//        if (fisica == true) {
//            if ($("#txtrfc").val().toUpperCase().match(/^[A-Z]{4}[ \-]?[0-9]{2}((0{1}[1-9]{1})|(1{1}[0-2]{1}))((0{1}[1-9]{1})|([1-2]{1}[0-9]{1})|(3{1}[0-1]{1}))[ \-]?[A-Z0-9]{3}$/)) {
//                $("#frmrfc").removeClass("has-error");
//                $("#frmrfc").addClass("has-success");
//                radios = $("#fisica").val();
//            } else {
//                $("#frmrfc").removeClass("has-success");
//                $("#frmrfc").addClass("has-error");
//                $("#txtrfc").focus();
//                alertify.error("RFC no valido para personas fisicas");
//                radios = $("#fisica").val();
//                return false;
//            }
//        }
//        if (moral == true) {
//            if ($("#txtrfc").val().toUpperCase().match(/^[A-Z]{3}[ \-]?[0-9]{2}((0{1}[1-9]{1})|(1{1}[0-2]{1}))((0{1}[1-9]{1})|([1-2]{1}[0-9]{1})|(3{1}[0-1]{1}))[ \-]?[A-Z0-9]{3}$/)) {
//                $("#frmrfc").removeClass("has-error");
//                $("#frmrfc").addClass("has-success");
//                radios = $("#moral").val();
//            } else {
//                $("#frmrfc").removeClass("has-success");
//                $("#frmrfc").addClass("has-error");
//                $("#txtrfc").focus();
//                alertify.error("RFC no valido para personas morales");
//                radios = $("#moral").val();
//
//                return false;
//            }
//        }
//
//        var info = "nombre=" + nombre + "&rfc=" + rfc + "&diascredito=" + diascredito + "&desctpf=" + desctpf + "&desctpp=" + desctpp + "&email=" + email + "&radios=" + radios;
//        $.get('editarProveedor.php', info, function(respuesta) {
//            var info = respuesta;
//            if (info == 2)
//            {
//                alertify.error("RFC no valido");
//                return false;
//            }
//            if (info == 3)
//            {
//                alertify.error("Error al gurdar direccion");
//                return false;
//            }
//            if (info == 1)
//            {
//                alertify.error("No agregaste una direccion");
//                return false;
//            } else {
//                $("#txtdesctpf").val("");
//                $("#txtdesctpp").val("");
//                $("#txtnombreproveedor").val("");
//                $("#txtrfc").val("");
//                $(".direccion").val("");
//
//                $("#txtemail").val("");
//                $("#txtdiascredito").val("");
//                $("#txtdescuento").val("");
//                $("#formulario").show("slow");
//                $("#mostrarDivProveedor").hide("slow");
//                $("#frmrfc").removeClass("has-success");
//                $("#frmrfc").removeClass("has-error");
//                $("#frmemail").removeClass("has-success");
//                $("#frmemail").removeClass("has-error");
//                $("#consultaProveedor").load("consultarProveedor.php", function() {
//                    $('#dtproveedor').dataTable();
//                });
//                $("#selectProveedor").load("mostrarProveedores.php", function() {
//                    $("#selectProveedor").selectpicker('refresh');
//                });
//                alertify.success("Proveedor editado correctamente");
//                return false;
//            }
//        });
    });

    $("#txtrfc").keyup(function() {
        var rfc = $("#txtrfc").val();
        var info = "rfc=" + rfc;
        $.get('verificandoProvedor.php', info, function(x) {
            if (x == 1) {
                $("#btneditardireccionproveedor").hide();
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
                $("#BuscarCodigo").val("");
                $.get('borrarVariable.php');
            } else {
                $("#btneditardireccionproveedor").show();
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
                    if (ind == "cp") {
                        $("#txtpostal").val(elem);

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

                    if (ind == "idDireccion") {
                        $("#extra").val(elem);

                    }
                    if (ind == "ciudad") {
                        alert(elem);
                        $("#txtciudad").val(elem);

                    }
                    if (ind == "estado") {
                        $("#txtestado").val(elem);

                    }
                    if (ind == "colonia") {
                        $("#BuscarCodigo").val(elem);


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

$("#canceloDireccion").click(function() {
    $("#txtcalle").val("");
    $("#txtnumeroexterior").val("");
    $("#txtnumerointerior").val("");
    $("#txtcruzamientos").val("");
    $("#txtpostal").val("");
    $("#txtestado").val("");
    $("#BuscarCodigo").val("");
    $("#txtciudad").val("");
    $('#mdlDireccion').modal('hide');
});

$("#btnguardardireccionproveedor").click(function() {
    var calle = $.trim($("#txtcalle").val().toUpperCase());
    var numeroexterior = $.trim($("#txtnumeroexterior").val().toUpperCase());
    var numerointerior = $.trim($("#txtnumerointerior").val().toUpperCase());
    var cruzamientos = $.trim($("#txtcruzamientos").val().toUpperCase());
    var postal = $.trim($("#txtpostal").val());
    var estado = $.trim($("#txtestado").val().toUpperCase());
    var colonia = $.trim($("#BuscarCodigo").val().toUpperCase());
    var ciudad = $.trim($("#txtciudad").val().toUpperCase());
    if (calle == "" || /^\s+$/.test(calle) || numeroexterior == "" || /^\s+$/.test(numeroexterior) || numerointerior == "" || /^\s+$/.test(numerointerior) || cruzamientos == "" || /^\s+$/.test(cruzamientos) || postal == "" || /^\s+$/.test(postal) || estado == "" || /^\s+$/.test(estado) || colonia == "" || /^\s+$/.test(colonia) || ciudad == "" || /^\s+$/.test(ciudad)) {
        alertify.error("Todos los campos son obligatorios");
    } else {
        $('#mdlDireccion').modal('hide');
    }
});

$("#btnguardarproveedor").click(function() {
    var nombre = $.trim($("#txtnombreproveedor").val().toUpperCase());
    var rfc = $("#txtrfc").val().toUpperCase();
    var diascredito = $("#txtdiascredito").val();
    var descuento = $("#txtdescuento").val();
    var email = $("#txtemail").val();
    var desctpf = $("#txtdesctpf").val();
    var desctpp = $("#txtdesctpp").val();

    var calle = $.trim($("#txtcalle").val().toUpperCase());
    var numeroexterior = $.trim($("#txtnumeroexterior").val().toUpperCase());
    var numerointerior = $.trim($("#txtnumerointerior").val().toUpperCase());
    var cruzamientos = $.trim($("#txtcruzamientos").val().toUpperCase());
    var postal = $.trim($("#txtpostal").val());
    var estado = $.trim($("#txtestado").val().toUpperCase());
    var colonia = $.trim($("#BuscarCodigo").val().toUpperCase());
    var ciudad = $.trim($("#txtciudad").val().toUpperCase());

    var radios;
    var emails = [];
    var telefonos = [];
    var datos = [];

    if (nombre == "" || /^\s+$/.test(nombre) || rfc == "" || /^\s+$/.test(rfc) || diascredito == "" || /^\s+$/.test(diascredito) || descuento == "" || /^\s+$/.test(descuento) || email == "" || /^\s+$/.test(email)) {
        alertify.error("Todos los campos son obligatorios");
        return false;
    }

    if (calle == "" || /^\s+$/.test(calle) || numeroexterior == "" || /^\s+$/.test(numeroexterior) || numerointerior == "" || /^\s+$/.test(numerointerior) || cruzamientos == "" || /^\s+$/.test(cruzamientos) || postal == "" || /^\s+$/.test(postal) || estado == "" || /^\s+$/.test(estado) || colonia == "" || /^\s+$/.test(colonia) || ciudad == "" || /^\s+$/.test(ciudad)) {
        alertify.error("Faltan datos de direccion");
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

    var direccion = new Direccion(calle, numeroexterior, numerointerior, cruzamientos, postal, colonia, ciudad, estado);
    var proveedor = new Proveedor(nombre, rfc, diascredito, desctpf, desctpp, radios);
    var ctrltelefonos = 0;

    $(".telefono").each(function() {
        var valor = $(this).val();
        if (valor == "" || /^\s+$/.test(valor)) {
            ctrltelefonos = 1;
        } else {
            telefonos.push(valor);
        }
    });
    if (ctrltelefonos == 1) {
        alertify.error("Hay un campo de telefono sin vacio");
        return false;
    }

    var ctrlemails = 0;
    $(".email").each(function() {
        var valor = $(this).val();
        if (valor.match(/^[a-zA-Z0-9\._-]+@[a-zA-Z0-9-]{2,}[.][a-zA-Z]{2,4}$/)) {
            emails.push(valor);
        } else {
            ctrlemails = 1;
        }
    });
    if (ctrlemails == 1) {
        alertify.error("Uno de los correos electronicos es invalido");
        return false;
    }

    datos.push(proveedor);
    datos.push(direccion);
    datos.push(telefonos);
    datos.push(emails);

    var datosJSON = JSON.stringify(datos);

    $.post('guardaProveedor.php', {datos: datosJSON}, function(rs) {

    });

//    var info = "nombre=" + nombre + "&rfc=" + rfc + "&diascredito=" + diascredito + "&desctpf=" + desctpf + "&desctpp=" + desctpp + "&email=" + email + "&radios=" + radios;
//    $.get('guardaProveedor.php', info, function(respuesta) {
//        var info = respuesta;
//        if (info == 2)
//        {
//            alertify.error("RFC no valido");
//            return false;
//        }
//        if (info == 3)
//        {
//            alertify.error("Error al gurdar direccion");
//            return false;
//        }
//        if (info == 1)
//        {
//            alertify.error("No agregaste una direccion");
//            return false;
//        } else {
//            $("#txtdesctpf").val("");
//            $("#txtdesctpp").val("");
//            $("#txtnombreproveedor").val("");
//            $("#txtrfc").val("");
//            $("#txtemail").val("");
//            $("#txtdiascredito").val("");
//            $("#txtdescuento").val("");
//            $(".direccion").val("");
//
//            $("#formulario").show("slow");
//            $("#mostrarDivProveedor").hide("slow");
//            $("#frmrfc").removeClass("has-success");
//            $("#frmrfc").removeClass("has-error");
//            $("#frmemail").removeClass("has-success");
//            $("#frmemail").removeClass("has-error");
//            $("#consultaProveedor").load("consultarProveedor.php", function() {
//                $('#dtproveedor').dataTable();
//            });
//            $("#selectProveedor").load("mostrarProveedores.php", function() {
//                $("#selectProveedor").selectpicker('refresh');
//            });
//            $("#txtrfc").focus();
//            alertify.success("Proveedor agregado correctamente");
//            return false;
//        }
//    });
});

