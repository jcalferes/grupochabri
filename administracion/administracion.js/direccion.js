function verficaPostal() {
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
        });
    }
}
$(document).ready(function() {
    $("#selectColonia").attr("disabled", "disabled");
    $("#txtciudad").attr("disabled", "disabled");
    $("#txtestado").attr("disabled", "disabled");

    $(function() {
        $('#txtpostal').validCampoFranz('0123456789');
    });

    $("#btnguardardireccion").click(function() {
        var calle = $.trim($("#txtcalle").val().toUpperCase());
        var numeroexterior = $.trim($("#txtnumeroexterior").val().toUpperCase());
        var numerointerior = $.trim($("#txtnumerointerior").val().toUpperCase());
        var cruzamientos = $.trim($("#txtcruzamientos").val().toUpperCase());
        var postal = $.trim($("#txtpostal").val());
        var idcpostales = $("#selectColonia").val();
        var estado = $("#txtestado").val();

        if (calle == "" || numeroexterior == "" || numerointerior == "" || postal == "" || idcpostales == "" || cruzamientos == "" || /^\s+$/.test(calle) || /^\s+$/.test(numeroexterior) || /^\s+$/.test(numerointerior) || /^\s+$/.test(postal) || /^\s+$/.test(idcpostales) || /^\s+$/.test(cruzamientos)) {
            alertify.error("Todos los campos son obligatorios");
            return false;
        }
        else {
            if (estado == "" || /^\s+$/.test(estado)) {
                alertify.error("CP invalido");
                return false;
            } else {
                var info = "calle=" + calle + "&numeroexterior=" + numeroexterior + "&numerointerior=" + numerointerior + "&cruzamientos=" + cruzamientos + "&idcpostales=" + idcpostales;
                $.get('guardaDireccion.php', info, function() {

                    alertify.success("Direccion agregada correctamente");
                    return false;
                });
            }
        }
    });
    $("#btneditardireccion").click(function() {
        var calle = $.trim($("#txtcalle").val().toUpperCase());
        var postal = $.trim($("#txtpostal").val());
        var numeroexterior = $.trim($("#txtnumeroexterior").val().toUpperCase());
        var numerointerior = $.trim($("#txtnumerointerior").val().toUpperCase());
        var cruzamientos = $.trim($("#txtcruzamientos").val().toUpperCase());
        
        var idcpostales = $("#selectColonia").val();
        var estado = $("#txtestado").val();
        var extra = $("#extra").val();
        var ciudad = $("#txtciudad").val();

        if (calle == "" || numeroexterior == "" || numerointerior == "" || postal == "" || idcpostales == "" || cruzamientos == "" || /^\s+$/.test(calle) || /^\s+$/.test(numeroexterior) || /^\s+$/.test(numerointerior) || /^\s+$/.test(postal) || /^\s+$/.test(idcpostales) || /^\s+$/.test(cruzamientos)) {
            alertify.error("Todos los campos son obligatorios");
            return false;
        }
        else {
            if (estado == "" || /^\s+$/.test(estado)) {
                alertify.error("CP invalido");
                return false;
            } else {
                var info = "calle=" + calle + "&numeroexterior=" + numeroexterior + "&numerointerior=" + numerointerior + "&cruzamientos=" + cruzamientos + "&idcpostales=" + idcpostales + "&extra=" + extra;
                $.get('editarDireccion.php', info, function() {

                    alertify.success("Direccion editada correctamente");
                    return false;
                });
            }
        }
    });
});


