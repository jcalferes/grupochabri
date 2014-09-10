$(document).ready(function() {
    $("#slc_inventario").selectpicker();
    $("#losparametros").hide();
    $("#esporfecha").hide();
    $("#esporcliente").hide();
    $("#btnhacerconsulta").hide();
});

$("#slc_inventario").change(function() {
    var seleccion = $("#slc_inventario").val();
    if (seleccion == 1 | seleccion == 2) {
        $("#losparametros").slideDown();
        $("#btnhacerconsulta").slideDown();

    } else {
        $("input[name=optionsRadios]").prop('checked', false);
        $("#rbtn1").prop("checked", true);
        $("#txt_rfc").val("");
        $("#fecha_inicial").val("");
        $("#fecha_final").val("");
        $("#losparametros").slideUp();
        $("#esporfecha").slideUp();
        $("#esporcliente").slideUp();
        $("#btnhacerconsulta").slideUp();
    }
});

$("input[name=optionsRadios]").click(function() {
    var rbtn1 = $("#rbtn1").is(":checked");
    var rbtn2 = $("#rbtn2").is(":checked");
    var rbtn3 = $("#rbtn3").is(":checked");

    if (rbtn1 == true) {
        $("#esporfecha").slideUp();
        $("#esporcliente").slideUp();

        $("#txt_rfc").val("");
        $("#fecha_inicial").val("");
        $("#fecha_final").val("");
    }
    if (rbtn2 == true) {
        $("#esporfecha").slideDown();
        $("#esporcliente").slideUp();

        $("#txt_rfc").val("");
    }
    if (rbtn3 == true) {
        $("#esporfecha").slideUp();
        $("#esporcliente").slideDown();

        $("#fecha_inicial").val("");
        $("#fecha_final").val("");
    }
});

$("#btnhacerconsulta").click(function() {
    var rbtn2 = $("#rbtn2").is(":checked");
    var rbtn3 = $("#rbtn3").is(":checked");

    if (rbtn2 == true) {
        var fecha_inicial = $("#fecha_inicial").val();
        var fecha_final = $("#fecha_final").val();
        if (fecha_inicial == "" || /^\s+$/.test(fecha_inicial)) {
            alertify.error("La fecha inicial no pude estar vacia");
            return false;
        }
        if (fecha_final == "" || /^\s+$/.test(fecha_final)) {
            alertify.error("La fecha final no pude estar vacia");
            return false;
        }
        if (fecha_inicial > fecha_final) {
            alertify.error("La fecha inicial no puede ser mayor que la final");
            return false;
        }
    }
    if (rbtn3 == true) {
        var txt_rfc = $("#txt_rfc").val();
        if (txt_rfc == "" || /^\s+$/.test(txt_rfc)) {
            alertify.error("El campo RFC no pude estar vacio");
            return false;
        }
    }
    
    var info = ""
});
