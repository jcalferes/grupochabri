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
                var contenido ="";
                
                for (var i in dataJson) {
                    contenido += "<datalist id='selectColonia'>"
                    +"<option value='" + dataJson[i].asenta + "'>" + dataJson[i].asenta + "</option> \n\
                    </datalist>";
                    $("#txtciudad").val(dataJson[i].ciudad);
                    $("#txtestado").val(dataJson[i].estado);

                }
                
                return contenido;
            });
        });
    }
}
$(document).ready(function() {
//    $("#selectColonia").attr("disabled", "disabled");
//    $("#txtciudad").attr("disabled", "disabled");
//    $("#txtestado").attr("disabled", "disabled");
$("#Buscar").click(function(){
        verficaPostal();
    
});
    $(function() {
        $('#txtpostal').validCampoFranz('0123456789');
    });

    $("#btnguardardireccion").click(function() {
        var calle = $.trim($("#txtcalle").val().toUpperCase());
        var numeroexterior = $.trim($("#txtnumeroexterior").val().toUpperCase());
        var numerointerior = $.trim($("#txtnumerointerior").val().toUpperCase());
        var cruzamientos = $.trim($("#txtcruzamientos").val().toUpperCase());
        var postal = $.trim($("#txtpostal").val());
//        var idcpostales = $("#selectColonia").val();
        var estado = $("#txtestado").val();
        var colonia = $("#BuscarCodigo").val();
        var ciudad = $("#txtciudad").val();
        var estado = $("#txtestado").val();
//        alert(colonia);
        if (calle == "" || numeroexterior == "" || numerointerior == "" || postal == "" ||  cruzamientos == "" || /^\s+$/.test(calle) || /^\s+$/.test(numeroexterior) || /^\s+$/.test(numerointerior) || /^\s+$/.test(postal) || /^\s+$/.test(cruzamientos) || colonia == "" || ciudad == "" || estado == "") {
            alertify.error("Todos los campos son obligatorios");
            return false;
        }
        else {
            if (estado == "" || /^\s+$/.test(estado)) {
                alertify.error("CP invalido");
                return false;
            } else {
                var info = "calle=" + calle + "&numeroexterior=" + numeroexterior + "&numerointerior=" + numerointerior + "&cruzamientos=" + cruzamientos +  "&colonia=" + colonia + "&estado=" + estado + "&ciudad=" + ciudad+ "&postal=" +postal;
                $.get('guardaDireccion.php', info, function() {

                    alertify.success("Direccion agregada correctamente");
                    return false;
                });
            }
        }
    });
    $("#btneditardireccion").click(function() {
        $("#txtpostal").blur();
        var calle = $.trim($("#txtcalle").val().toUpperCase());
        var postal = $.trim($("#txtpostal").val());
        var numeroexterior = $.trim($("#txtnumeroexterior").val().toUpperCase());
        var numerointerior = $.trim($("#txtnumerointerior").val().toUpperCase());
        var cruzamientos = $.trim($("#txtcruzamientos").val().toUpperCase());
        var colonia = $("#BuscarCodigo").val();
        var ciudad = $("#txtciudad").val();
        var estado = $("#txtestado").val();
//        var idcpostales = $("#selectColonia").val();
      
        var extra = $("#extra").val();
//        var ciudad = $("#txtciudad").val();

        if ( estado == "" || ciudad == "" || colonia == "" || calle == "" || numeroexterior == "" || numerointerior == "" || postal == ""  || cruzamientos == "" || /^\s+$/.test(calle) || /^\s+$/.test(numeroexterior) || /^\s+$/.test(numerointerior) || /^\s+$/.test(postal) ||  /^\s+$/.test(cruzamientos)) {
            alertify.error("Todos los campos son obligatorios");
            return false;
        }
        else {
            if (estado == "" || /^\s+$/.test(estado)) {
                alertify.error("CP invalido");
                return false;
            } else {
                var info = "calle=" + calle + "&numeroexterior=" + numeroexterior + "&numerointerior=" + numerointerior + "&cruzamientos=" + cruzamientos +  "&extra=" + extra + "&ciudad=" + ciudad + "&estado=" + estado + "&colonia=" + colonia+ "&postal=" + postal;
                $.get('editarDireccion.php', info, function() {

                    alertify.success("Direccion editada correctamente");
                    return false;
                });
            }
        }
    });
});


