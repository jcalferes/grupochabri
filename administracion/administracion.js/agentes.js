var acuantostel = 0;
var acuantosemail = 0;
var atxttel = "mastel";
var atxtemail = "masemail";
var acadena = "";

$(document).ready(function() {
    $("#btneditaragt").hide();
});

function aplicarValidacion() {
    $(".atelefono").validCampoFranz('0123456789()');
    $(".aemail").validCampoFranz('abcdefghijklmnñopqrstuvwxyzáéiou1234567890°!#$%&()=?¡¬´+~{}[]-_.:,;');
}

$("#btnotrotelagt").click(function() {
    acuantostel++;
    acadena = atxttel + acuantostel;
    $("#mastelsagt").append("<div id=" + acadena + " class=\"input-group\" style=\"margin-top: 10px; width: 57%;\" ><input type=\"text\" class=\"atelefono form-control\"><span class=\"input-group-btn\"><button class=\"btn btn-default\" onclick='borratel(\"" + acadena + "\")' type=\"button\"><span class=\"glyphicon glyphicon-remove\"></span></button></span></div>");
    aplicarValidacion();
});

$("#btnotroemailagt").click(function() {
    acuantosemail++;
    acadena = atxtemail + acuantosemail;
    $("#masemailsagt").append("<div id=" + acadena + " class=\"input-group\" style=\"margin-top: 10px; width: 57%;\" ><input type=\"text\" class=\"aemail form-control\"><span class=\"input-group-btn\"><button class=\"btn btn-default\" onclick='borratel(\"" + acadena + "\")' type=\"button\"><span class=\"glyphicon glyphicon-remove\"></span></button></span></div>");
    aplicarValidacion();
});

$("#btnguardaragt").click(function() {
    var idproveedor = $("#selectProveedor").val().toUpperCase();
    var nombre = $("#txtnombreagt").val();

    var aemails = [];
    var atelefonos = [];
    var adatos = [];

    if (idproveedor == 0) {
        alertify.error("No seleccionaste un proveedor");
        return false;
    }

    if (nombre == "" || /^\s+$/.test(nombre)) {
        alertify.error("Todos los campos son obligatorios");
        return false;
    }

    var ctrltelefonos = 0;
    $(".atelefono").each(function() {
        var valor = $(this).val();
        if (valor == "" || /^\s+$/.test(valor)) {
            ctrltelefonos = 1;
        } else {
            atelefonos.push(valor);
        }
    });
    if (ctrltelefonos == 1) {
        alertify.error("Hay un campo de telefono vacio");
        return false;
    }

    var ctrlemails = 0;
    $(".aemail").each(function() {
        var valor = $(this).val();
        if (valor.match(/^[a-zA-Z0-9\._-]+@[a-zA-Z0-9-]{2,}[.][a-zA-Z]{2,4}$/)) {
            aemails.push(valor);
        } else {
            ctrlemails = 1;
        }
    });
    if (ctrlemails == 1) {
        alertify.error("Uno de los correos electronicos es invalido");
        return false;
    }

    adatos.push(idproveedor);
    adatos.push(nombre);
    adatos.push(atelefonos);
    adatos.push(aemails);

    var adatosJSON = JSON.stringify(adatos);
    $.post('guardarAgentes.php', {adatos: adatosJSON}, function(rs) {
        if (rs == 0) {
            alertify.success("Agente guardado");
            $("#selectProveedor").selectpicker('val', 0);
            $("#txtnombreagt").val("");
            $("#txttelagt").val("");
            $("#txtemailagt").val("");

            $("#mastelsagt").remove();
            $("#masemailsagt").remove();

            $("#afrmtel").append("<div id='mastelsagt'></div>");
            $("#afrmemail").append("<div id='masemailsagt'></div>");
        } else {
            alert("ERROR: NO SE PUDO COMPLETAR LA ACCION");
        }
    });
});