var cuantostel = 0;
var cuantosemail = 0;
var txttel = "mastel";
var txtemail = "masemail";
var cadena = "";

function Proveedor(nombre, rfc, credito, diascredito, desctpf, desctpp, radios, pass, user) {
    this.nombre = nombre;
    this.rfc = rfc;
    this.credito = credito;
    this.diascredito = diascredito;
    this.desctpf = desctpf;
    this.desctpp = desctpp;
    this.radios = radios;
    this.pass = pass;
    this.user = user;
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
    $(".email").validCampoFranz('@abcdefghijklmnñopqrstuvwxyzáéiou1234567890°!#$%&()=?¡¬´+~{}[]-_.:,;@');
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

function eliminarClientes() {
    var idCliente = new Array();
    var info;
    $("#dtcliente").find(':checked').each(function() {
        var elemento = this;
        var valor = elemento.value;
        idCliente.push(valor);
        lista = JSON.stringify(idCliente);
        info = "clientes=" + lista;
    });
    if (info != undefined) {
        alertify.confirm("Desea Eliminar los Clientes seleccionadas?", function(e) {
            if (e) {
                $.get('eliminaClientes.php', info, function() {
                    $("#consultaCliente").load("consultarCliente.php", function() {
                        $('#dtcliente').dataTable();
                    });
                    alertify.success("se han dado de baja de manera correcta");
                });
            } else {
            }
        });
        return false;
    } else {
        alertify.error("Debe seleccionar al menos un Cliente");
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
//                alert(contenido);
                return contenido;
            });
        });
    }
}

function verDireccion(id, rfc) {

    var info = "id=" + id + "&rfc=" + rfc;
    $("#verdireccion").load("consultaDireccionC.php", info, function() {
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

function verAbonos(folio) {
    var info = "folio=" + folio;
    $("#tblabonos").load("consultarAbonos.php", info, function() {
        $("#dtabonos").dataTable();
    });
    $("#mdlverabonos").modal('show');
}

$(document).ready(function() {
    var saldos = 0;
    var creditos = 0;
    $(":input:first").focus();
    $("#botonNinja").hide();
    $("#btneditardireccionproveedor").hide();
    $("#btneditarproveedor").hide();

    $("#consultaCliente").load("consultarCliente.php", function() {
        $('#dtcliente').dataTable();
    });

    $("#consultadeudores").load("consultarDeudores.php", function() {
        $('#dtdeudores').dataTable();
        $("#dtdeudores").find('.saldos').each(function() {
            var elemento = this;
            var valor = elemento.value;
            saldos = saldos + parseFloat(valor);
        });
        $("#dtdeudores").find('.creditos').each(function() {
            var elemento = this;
            var valor = elemento.value;
            creditos = creditos + parseFloat(valor);
        });
        var abonos = creditos - saldos;
        $("#deudorescreditototal").text(creditos);
        $("#deudoresabonostotal").text(abonos);
        $("#deudoressaldototal").text(saldos);
    });

    $(function() {
        $(".telefono").validCampoFranz('0123456789()');
        $(".email").validCampoFranz('@abcdefghijklmnñopqrstuvwxyzáéiou1234567890°!#$%&()=?¡¬´+~{}[]-_.:,;');
        $('#txtrfc').validCampoFranz('abcdefghijklmnñopqrstuvwxyzáéiou1234567890°!#$%&()=?¡¬´+~{}[]-_.:,; ');
        $('#txtcredito').validCampoFranz('0123456789.');
        $('#txtdiascredito').validCampoFranz('0123456789');
        $('#txtdesctpf').validCampoFranz('0123456789');
        $('#txtdesctpp').validCampoFranz('0123456789');
        $("#txtnombreproveedor").validCampoFranz(' abcdefghijklmnñopqrstuvwxyzáéiou1234567890°!#$%&()=?¡¬´+~{}[]-_.:,;' );
        $('#txtemail').validCampoFranz('abcdefghijklmnñopqrstuvwxyz1234567890<>@,;.:-_^{[}]+¿¡?=)(/&%$#!|°');
        $("#txtestado").validCampoFranz('abcdefghijklmnñopqrstuvwxyzáéiou1234567890°!#$%&()=?¡¬´+~{}[]-_.:,; ');
        $("#BuscarCodigo").validCampoFranz(' abcdefghijklmnñopqrstuvwxyzáéiou1234567890°!#$%&/()=?¡|¬?¨*´+~{}[]-_.:,;');
        $("#txtciudad").validCampoFranz(' abcdefghijklmnñopqrstuvwxyzáéiou1234567890°!#$%&/()=?¡|¬?¨*´+~{}[]-_.:,;');
    });
});

$("#btneditarproveedor").click(function() {
    var nombre = $.trim($("#txtnombreproveedor").val().toUpperCase());
    var rfc = $("#txtrfc").val().toUpperCase();
    var credito = $("#txtcredito").val();
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

    if (nombre == "" || /^\s+$/.test(nombre) || rfc == "" || /^\s+$/.test(rfc) || diascredito == "" || /^\s+$/.test(diascredito) || descuento == "" || /^\s+$/.test(descuento) || credito == "" || /^\s+$/.test(credito)) {
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
    var proveedor = new Proveedor(nombre, rfc, credito, diascredito, desctpf, desctpp, radios);

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

    $.post('editarCliente.php', {datos: datosJSON}, function(rs) {
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

            $("#consultaCliente").load("consultarCliente.php", function() {
                $('#dtcliente').dataTable();
            });

            alertify.success("Cliente editado correctamente");
        }
        if (rs == 1) {
            alertify.error("Error al guardar");
        }
    });
});

$("#txtrfc").blur(function() {
    var rfc = $("#txtrfc").val();
    var info = "rfc=" + rfc;
    $.get('verificandoCliente.php', info, function(rs) {
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
            $("#txtcredito").val("");
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
            $("#txtcredito").val(arr.proveedor.datos.credito);
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
    var user = $("#txtcuser").val();
    var pass = $("#txtcpass").val();
    var repass = $("#txtcrepass").val();
    var nombre = $.trim($("#txtnombreproveedor").val().toUpperCase());
    var rfc = $("#txtrfc").val().toUpperCase();
    var credito = $("#txtcredito").val();
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

    if (nombre == "" || /^\s+$/.test(nombre) || rfc == "" || /^\s+$/.test(rfc) || diascredito == "" || /^\s+$/.test(diascredito) || descuento == "" || /^\s+$/.test(descuento) || user == "" || /^\s+$/.test(user) || pass == "" || /^\s+$/.test(pass) || repass == "" || /^\s+$/.test(repass) || credito == "" || /^\s+$/.test(credito)) {
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

    if (pass !== repass) {
        alertify.error("Las contraseñas no coinciden");
        return false;
    }

    var direccion = new Direccion(calle, numeroexterior, numerointerior, cruzamientos, postal, colonia, ciudad, estado);
    var proveedor = new Proveedor(nombre, rfc, credito, diascredito, desctpf, desctpp, radios, pass, user);
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
    $.post('guardaCliente.php', {datos: datosJSON}, function(rs) {
        if (rs == 0) {
            $("#txtnombreproveedor").val("");
            $("#txtrfc").val("");
            $("#txtcredito").val("");
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

            $("#txtcuser").val("");
            $("#txtcpass").val("");
            $("#txtcrepass").val("");

            $("#btnvertele").attr("disabled", "disabled");
            $("#btnveremail").attr("disabled", "disabled");

            $("#mastels").remove();
            $("#masemails").remove();

            $("#frmtel").append("<div id='mastels'></div>");
            $("#frmemail").append("<div id='masemails'></div>");

            $("#consultaCliente").load("consultarCliente.php", function() {
                $('#dtcliente').dataTable();
            });

            alertify.success("Cliente agregado correctamente");
        }
        if (rs == 1) {
            alertify.error("Error al guardar");
        }
        if (rs == 999) {
            $("#consultaCliente").load("consultarCliente.php", function() {
                $('#dtcliente').dataTable();
            });
            alertify.error("Este cliente ya existe");
        }
        if (rs == 777) {
            alertify.error("El nombre de usuario ya existe");
        }
    });
});

function eliminardatoscontacto(id, tipo) {
    if (tipo == 0) {
        var contartels = 0;
        $("#tbltelefonos tbody tr").each(function() {
            contartels++;
        });
        if (contartels <= 1) {
            alertify.error("Imposible eliminar, debe existir al menos un telefono para este cliente");
        } else {
            var info = "id=" + id + "&tipo=" + tipo;
            $.get('eliminarContactos.php', info, function(rs) {
                if (rs == 00 || rs == 01) {
                    alertify.success("Datos eliminados");
                    actualizaTablasTelMail();
                } else {
//                    alert(rs);
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
            alertify.error("Imposible eliminar, debe existir al menos un email para este cliente");
        } else {
            var info = "id=" + id + "&tipo=" + tipo;
            $.get('eliminarContactos.php', info, function(rs) {
                if (rs == 00 || rs == 01) {
                    actualizaTablasTelMail();
                    alertify.success("Datos eliminados");
                } else {
//                    alert(rs);
                }
            });
        }
    }
}

function actualizaTablasTelMail() {
    var rfc = $("#txtrfc").val();
    var info = "rfc=" + rfc;
    $.get('verificandoCliente.php', info, function(rs) {
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