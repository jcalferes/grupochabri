function verficaPostal() {
    $("#selectColonia").removeAttr("disabled", "disabled");
//    $("#txtciudad").removeAttr("disabled", "disabled");
//    $("#txtestado").removeAttr("disabled", "disabled");
    var postal = $("#txtpostal").val();
    if (postal == "" || /^\s+$/.test(postal)) {
        alertify.error("ERROR");
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
//            for (var i in dataJson) {
////          alert(dataJson[i].idcpostales + " _ " + dataJson[i].cp + " _ " + dataJson[i].asenta + " _ " + dataJson[i].estado + " _ " + dataJson[i].ciudad);
//                $("#txtciudad").val(dataJson[i].ciudad);
//                $("#txtestado").val(dataJson[i].estado);
//            }
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
        var calle = $("#txtcalle").val();
        var numeroexterior = $("#txtnumeroexterior").val();
        var numerointerior = $("#txtnumerointerior").val();
        var postal = $("#txtpostal").val();
        var idcpostales = $("#selectColonia").val();

        if (calle == "" || numeroexterior == "" || numerointerior == "" || postal == "" || idcpostales == "" || /^\s+$/.test(calle) || /^\s+$/.test(numeroexterior) || /^\s+$/.test(numerointerior) || /^\s+$/.test(postal) || /^\s+$/.test(idcpostales)) {
            alertify.error("Todos los campos son obligatorios");
            return false;
        }
        else {
            var info = "calle=" + calle + "&numeroexterior=" + numeroexterior + "&numerointerior=" + numerointerior + "&idcpostales=" + idcpostales;
            $.get('guardaDireccion.php', info, function() {
                alertify.success("Direccion agregada correctamente");
            });
        }
    });
});


