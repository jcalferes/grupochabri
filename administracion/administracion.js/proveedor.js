var cuantostel = 0;
var cuantosemail = 0;
var txttel = "mastel";
var txtemail = "masemail";
var cadena = "";

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
    $("#mastels").append("<div id=" + cadena + " class=\"input-group\" style=\"margin-top: 10px; width: 57%;\" ><input type=\"text\" class=\"telefono form-control\"><span class=\"input-group-btn\"><button class=\"btn btn-default\" onclick='borratel(\"" + cadena + "\")' type=\"button\"><span class=\"glyphicon glyphicon-remove\"></span></button></span></div>");
    aplicarValidacion();
});

function aplicarValidacion() {
    $(".telefono").validCampoFranz('0123456789()');
    $(".email").validCampoFranz('abcdefghijklmnñopqrstuvwxyz1234567890<>@,;.:-_^{[}]+¿¡?=)(/&%$#!|°');
}

$("#btnotroemail").click(function() {
    cuantosemail++;
    cadena = txtemail + cuantosemail;
    $("#masemails").append("<div id=" + cadena + " class=\"input-group\" style=\"margin-top: 10px; width: 57%;\" ><input type=\"text\" class=\"email form-control\"><span class=\"input-group-btn\"><button class=\"btn btn-default\" onclick='borratel(\"" + cadena + "\")' type=\"button\"><span class=\"glyphicon glyphicon-remove\"></span></button></span></div>");
    aplicarValidacion();
});

function borratel(cadena) {
    $("#" + cadena).remove();
}

function borraemail(cadena) {
    $("#" + cadena).remove();
}

//function eliminarProveedores() {
//    var idProveedor = new Array();
//    var info;
//
//    $("#dtproveedor").find(':checked').each(function() {
//        var elemento = this;
//        var valor = elemento.value;
//        idProveedor.push(valor);
//        lista = JSON.stringify(idProveedor);
//        info = "proveedor=" + lista;
//    });
//    if (info != undefined) {
//        alertify.confirm("Desea Eliminar los proveedores seleccionadas?", function(e) {
//            if (e) {
//                $.get('eliminaProveedor.php', info, function() {
//                    alertify.success("se han dado de baja de manera correcta")
//                    $("#consultaProveedor").load("consultarProveedor.php", function() {
//                        $('#dtProveedor').dataTable();
//                    });
//                });
//            } else {
//            }
//        });
//        return false;
//    } else {
//        alertify.error("Debe selecciona al menos un proveedor");
//    }
//}

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
                return contenido;
            });
        });
    }
}

function verDireccion(id, rfc) {

    var info = "id=" + id + "&rfc=" + rfc;
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

$("#btncanceloProveedor").click(function() {
    $("#txtnombreproveedor").val("");
    $("#txtrfc").val("");
    $("#txtdiascredito").val("");
    $("#txtdescuento").val("");
    $("#formulario").show("slow");
    $("#mostrarDivProveedor").hide("slow");
});


$(document).ready(function() {
    $(":input:first").focus();
    $("#botonNinja").hide();
    $("#btneditardireccionproveedor").hide();
    $("#btneditarproveedor").hide();

    $("#consultaProveedor").load("consultarProveedor.php", function() {
        $('#dtproveedor').dataTable();
    });

    $("#dgproveedor").load("mostrarProveedores.php", function() {
        $("#selectProveedor").selectpicker();
    });

    $(function() {
        $(".telefono").validCampoFranz('0123456789()');
        $(".email").validCampoFranz('abcdefghijklmnñopqrstuvwxyz1234567890<>@,;.:-_^{[}]+¿¡?=)(/&%$#!|°');
        $('#txtrfc').validCampoFranz('abcdefghijklmnñopqrstuvwxyzáéiou1234567890°!#$%&/()=?¡|¬?¨*´+~{}[]-_.:,;');
        $('#txtdiascredito').validCampoFranz('0123456789');
        $('#txtdesctpf').validCampoFranz('0123456789');
        $('#txtdesctpp').validCampoFranz('0123456789');
        $("#txtnombreproveedor").validCampoFranz(' abcdefghijklmnñopqrstuvwxyzáéiou1234567890°!#$%&()=?¡¬´+~{}[]-_.:,; ');
        $('#txtemail').validCampoFranz('abcdefghijklmnñopqrstuvwxyz1234567890<>@,;.:-_^{[}]+¿¡?=)(/&%$#!|°');
        $("#txtestado").validCampoFranz(' abcdefghijklmnñopqrstuvwxyzáéiou1234567890°!#$%&/()=?¡|¬?¨*´+~{}[]-_.:,;');
        $("#BuscarCodigo").validCampoFranz(' abcdefghijklmnñopqrstuvwxyzáéiou1234567890°!#$%&/()=?¡|¬?¨*´+~{}[]-_.:,;');
        $("#txtciudad").validCampoFranz(' abcdefghijklmnñopqrstuvwxyzáéiou1234567890°!#$%&/()=?¡|¬?¨*´+~{}[]-_.:,;');
    });
});

$("#btneditarproveedor").click(function() {
    var nombre = $.trim($("#txtnombreproveedor").val().toUpperCase());
    var rfc = $("#txtrfc").val().toUpperCase();
    var diascredito = $("#txtdiascredito").val();
    var descuento = $("#txtdescuento").val();
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

    if (nombre == "" || /^\s+$/.test(nombre) || rfc == "" || /^\s+$/.test(rfc) || diascredito == "" || /^\s+$/.test(diascredito) || descuento == "" || /^\s+$/.test(descuento)) {
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

    $(".telefono").each(function() {
        var valor = $(this).val();
        if (valor == "" || /^\s+$/.test(valor)) {
        } else {
            telefonos.push(valor);
        }
    });

    $(".email").each(function() {
        var valor = $(this).val();
        if (valor.match(/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/)) {
            emails.push(valor);
        }
    });

    datos.push(proveedor);
    datos.push(direccion);
    datos.push(telefonos);
    datos.push(emails);

    var datosJSON = JSON.stringify(datos);

    $.post('editarProveedor.php', {datos: datosJSON}, function(rs) {
        if (rs == 0) {
            $("#txtnombreproveedor").val("");
            $("#txtrfc").val("");
            $("#txtdiascredito").val("");
            $("#txtdescuento").val("");
            $("#txttel").val("");
            $("#txtemail").val("");
            $("#txtdesctpf").val("");
            $("#txtdesctpp").val("");

            $("#txtcalle").val("");
            $("#txtnumeroexterior").val("");
            $("#txtnumerointerior").val("");
            $("#txtcruzamientos").val("");
            $("#txtpostal").val("");
            $("#txtestado").val("");
            $("#BuscarCodigo").val("");
            $("#txtciudad").val("");

            $("#btnvertele").attr("disabled", "disabled");
            $("#btnveremail").attr("disabled", "disabled");

            $("#btneditardireccionproveedor").hide();
            $("#btnguardardireccionproveedor").show();
            $("#canceloDireccion").show();
            $("#btneditarproveedor").hide();
            $("#btnguardarproveedor").show();

            $("#mastels").remove();
            $("#masemails").remove();

            $("#frmtel").append("<div id='mastels'></div>");
            $("#frmemail").append("<div id='masemails'></div>");

            $("#consultaProveedor").load("consultarProveedor.php", function() {
                $('#dtproveedor').dataTable();
            });

            $("#selectProveedor").load("mostrarProveedores.php", function() {
                $("#selectProveedor").selectpicker('refresh');
            });

            alertify.success("Proveedor editado correctamente");
        }
        if (rs == 1) {
            alertify.error("Error al guardar");
        }
    });
});

$("#txtrfc").blur(function() {
    var rfc = $("#txtrfc").val();
    var info = "rfc=" + rfc;
    $.get('verificandoProvedor.php', info, function(rs) {
        if (rs == 0) {
            $("#btneditardireccionproveedor").hide();
            $("#btnguardardireccionproveedor").show();
            $("#canceloDireccion").show();
            $("#btneditarproveedor").hide();
            $("#btnguardarproveedor").show();

            $("#tbltelefonos tbody tr").remove();
            $("#tblemails tbody tr").remove();

            $("#btnvertele").attr("disabled", "disabled");
            $("#btnveremail").attr("disabled", "disabled");

            $("#txtnombreproveedor").val("");
            $("#txtdiascredito").val("");
            $("#txtdesctpf").val("");
            $("#txtdesctpp").val("");

            $("#txtcalle").val("");
            $("#txtnumeroexterior").val("");
            $("#txtnumerointerior").val("");
            $("#txtcruzamientos").val("");
            $("#txtpostal").val("");
            $("#txtestado").val("");
            $("#BuscarCodigo").val("");
            $("#txtciudad").val("");

        } else {
            var arr = $.parseJSON(rs);
            $("#btneditardireccionproveedor").show();
            $("#btnguardardireccionproveedor").hide();
            $("#canceloDireccion").hide();
            $("#btneditarproveedor").show();
            $("#btnguardarproveedor").hide();

            $("#tbltelefonos tbody tr").remove();
            $("#tblemails tbody tr").remove();

            $("#btnvertele").removeAttr("disabled", "disabled");
            $("#btnveremail").removeAttr("disabled", "disabled");

            $("#txtnombreproveedor").val(arr.proveedor.datos.nombre);
            $("#txtdiascredito").val(arr.proveedor.datos.diascredito);
            $("#txtdesctpf").val(arr.proveedor.datos.descuentopf);
            $("#txtdesctpp").val(arr.proveedor.datos.descuentopp);
            var radios = arr.proveedor.datos.tipoproveedor;
            if (radios == "FISICA") {
                $("#fisica").prop("checked", true);
            }
            if (radios == "MORAL") {
                $("#moral").prop("checked", true);
            }

            $("#txtcalle").val(arr.direccion.datos.calle);
            $("#txtnumeroexterior").val(arr.direccion.datos.numeroext);
            $("#txtnumerointerior").val(arr.direccion.datos.numeroint);
            $("#txtcruzamientos").val(arr.direccion.datos.cruzamientos);
            $("#txtpostal").val(arr.direccion.datos.postal);
            $("#txtestado").val(arr.direccion.datos.estado);
            $("#BuscarCodigo").val(arr.direccion.datos.colonia);
            $("#txtciudad").val(arr.direccion.datos.ciudad);

            var contartels = arr.telefonos.datos.length;
            var contaremas = arr.emails.datos.length;

            for (var i = 0; i < contartels; i++) {
                $("#tbltelefonos tbody").append("<tr><td class='eliminartel'>" + arr.telefonos.datos[i].telefono + "</td><td><center><button type='button' class='btn btn-xs' onclick='eliminardatoscontacto(" + arr.telefonos.datos[i].idTelefonos + ", 0);'><span class='glyphicon glyphicon-remove'></span></button></center></td></tr>");
            }
            for (var i = 0; i < contaremas; i++) {
                $("#tblemails tbody").append("<tr><td>" + arr.emails.datos[i].email + "</td><td><center><button type='button' class='btn btn-xs' onclick='eliminardatoscontacto(" + arr.emails.datos[i].idEmail + ", 1);'><span class='glyphicon glyphicon-remove'></span></button></center></td></tr>");
            }
        }
    });
});

$("#btnvertele").click(function() {
    $('#mdltelefonos').modal('show');
});

$("#btnveremail").click(function() {
    $('#mdlemails').modal('show');
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

$("#btneditardireccionproveedor").click(function() {
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

    if (nombre == "" || /^\s+$/.test(nombre) || rfc == "" || /^\s+$/.test(rfc) || diascredito == "" || /^\s+$/.test(diascredito) || descuento == "" || /^\s+$/.test(descuento)) {
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
        alertify.error("Hay un campo de telefono vacio");
        return false;
    }

    var ctrlemails = 0;
    $(".email").each(function() {
        var valor = $(this).val();
        if (valor.match(/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/)) {
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
        if (rs == 0) {
            $("#txtnombreproveedor").val("");
            $("#txtrfc").val("");
            $("#txtdiascredito").val("");
            $("#txtdescuento").val("");
            $("#txttel").val("");
            $("#txtemail").val("");
            $("#txtdesctpf").val("");
            $("#txtdesctpp").val("");

            $("#txtcalle").val("");
            $("#txtnumeroexterior").val("");
            $("#txtnumerointerior").val("");
            $("#txtcruzamientos").val("");
            $("#txtpostal").val("");
            $("#txtestado").val("");
            $("#BuscarCodigo").val("");
            $("#txtciudad").val("");

            $("#btnvertele").attr("disabled", "disabled");
            $("#btnveremail").attr("disabled", "disabled");

            $("#mastels").remove();
            $("#masemails").remove();

            $("#frmtel").append("<div id='mastels'></div>");
            $("#frmemail").append("<div id='masemails'></div>");

            $("#consultaProveedor").load("consultarProveedor.php", function() {
                $('#dtproveedor').dataTable();
            });

            alertify.success("Proveedor agregador correctamente");
        }
        if (rs == 1) {
            alertify.error("Error al guardar");
        }
        if (rs == 999) {
            $("#consultaProveedor").load("consultarProveedor.php", function() {
                $('#dtproveedor').dataTable();
            });
            $("#selectProveedor").load("mostrarProveedores.php", function() {
                $("#selectProveedor").selectpicker('refresh');
            });
            alertify.error("Este proveedor ya existe");
        }
        $("#selectProveedor").load("mostrarProveedores.php", function() {
            $("#selectProveedor").selectpicker('refresh');
        });
        $("#mostrarDivProveedor").hide("slow");
        $("#formulario").show("slow");
    });
});

function eliminardatoscontacto(id, tipo) {
    if (tipo == 0) {
        var contartels = 0;
        $("#tbltelefonos tbody tr").each(function() {
            contartels++;
        });
        if (contartels <= 1) {
            alertify.error("Imposible eliminar, debe existir al menos un telefono para este proveedor");
        } else {
            var info = "id=" + id + "&tipo=" + tipo;
            $.get('eliminarContactos.php', info, function(rs) {
                if (rs == 00 || rs == 01) {
                    alertify.success("Datos eliminados");
                    actualizaTablasTelMail();
                } else {
                }
            });
        }
    }
    if (tipo == 1) {
        var contaremas = 0;
        $("#tblemails tbody tr").each(function() {
            contaremas++;
        });
        if (contaremas <= 1) {
            alertify.error("Imposible eliminar, debe existir al menos un email para este proveedor");
        } else {
            var info = "id=" + id + "&tipo=" + tipo;
            $.get('eliminarContactos.php', info, function(rs) {
                if (rs == 00 || rs == 01) {
                    actualizaTablasTelMail();
                    alertify.success("Datos eliminados");
                } else {
                }
            });
        }
    }
}

function actualizaTablasTelMail() {
    var rfc = $("#txtrfc").val();
    var info = "rfc=" + rfc;
    $.get('verificandoProvedor.php', info, function(rs) {
        var arr = $.parseJSON(rs);
        $("#tbltelefonos tbody tr").remove();
        $("#tblemails tbody tr").remove();
        var contartels = arr.telefonos.datos.length;
        var contaremas = arr.emails.datos.length;
        for (var i = 0; i < contartels; i++) {
            $("#tbltelefonos tbody").append("<tr><td class='eliminartel'>" + arr.telefonos.datos[i].telefono + "</td><td><center><button type='button' class='btn btn-xs' onclick='eliminardatoscontacto(" + arr.telefonos.datos[i].idTelefonos + ", 0);'><span class='glyphicon glyphicon-remove'></span></button></center></td></tr>");
        }
        for (var i = 0; i < contaremas; i++) {
            $("#tblemails tbody").append("<tr><td>" + arr.emails.datos[i].email + "</td><td><center><button type='button' class='btn btn-xs' onclick='eliminardatoscontacto(" + arr.emails.datos[i].idEmail + ", 1);'><span class='glyphicon glyphicon-remove'></span></button></center></td></tr>");
        }
    });
}