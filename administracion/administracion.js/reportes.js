$(document).ready(function () {
    $("#slc_inventario").selectpicker();
    $("#losparametros").hide();
    $("#esporfecha").hide();
    $("#esporcliente").hide();
    $("#esporvendedor").hide();
    $("#btnhacerconsulta").hide();
});

$("#slc_inventario").change(function () {
    var seleccion = $("#slc_inventario").val();
    alert(seleccion);
    if (seleccion == 1 | seleccion == 2) {
        $("#losparametros").slideDown();
        $("#btnhacerconsulta").slideDown();
        if (seleccion == 1) {
            $('.nocancel').slideUp();
        } else {
            $('.nocancel').slideDown();
        }

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

$("input[name=optionsRadios]").click(function () {
    var rbtn1 = $("#rbtn1").is(":checked");
    var rbtn2 = $("#rbtn2").is(":checked");
    var rbtn3 = $("#rbtn3").is(":checked");
    var rbtn4 = $("#rbtn4").is(":checked");
    var rbtn5 = $("#rbtn5").is(":checked");
    var rbtn6 = $("#rbtn6").is(":checked");

    if (rbtn1 == true) {
        $("#esporfecha").slideUp();
        $("#esporcliente").slideUp();
        $("#esporvendedor").slideUp();

        $("#txt_rfc").val("");
        $("#fecha_inicial").val("");
        $("#fecha_final").val("");
    }
    if (rbtn2 == true) {
        $("#esporfecha").slideDown();
        $("#esporcliente").slideUp();
        $("#esporvendedor").slideUp();

        $("#txt_rfc").val("");
        $("#txt_user").val("");

    }
    if (rbtn3 == true) {
        $("#esporfecha").slideUp();
        $("#esporcliente").slideDown();
        $("#esporvendedor").slideUp();

        $("#fecha_inicial").val("");
        $("#fecha_final").val("");
        $("#txt_user").val("");

    }
    if (rbtn4 == true) {
        $("#esporfecha").slideUp();
        $("#esporcliente").slideUp();
        $("#esporvendedor").slideDown();

        $("#fecha_inicial").val("");
        $("#fecha_final").val("");
        $("#txt_rfc").val("");
    }
    if (rbtn5 == true) {
        $("#esporcliente").slideDown();
        $("#esporfecha").slideDown();
        $("#esporvendedor").slideUp();

        $("#fecha_inicial").val("");
        $("#fecha_final").val("");
        $("#txt_user").val("");
    }
    if (rbtn6 == true) {
        $("#esporcliente").slideUp();
        $("#esporfecha").slideDown();
        $("#esporvendedor").slideDown();

        $("#fecha_inicial").val("");
        $("#fecha_final").val("");
        $("#txt_rfc").val("");
    }
});

$("#btnhacerconsulta").click(function () {
    var rbtn1 = $("#rbtn1").is(":checked");
    var rbtn2 = $("#rbtn2").is(":checked");
    var rbtn3 = $("#rbtn3").is(":checked");
    var rbtn4 = $("#rbtn4").is(":checked");
    var rbtn5 = $("#rbtn5").is(":checked");
    var rbtn6 = $("#rbtn6").is(":checked");

    var bnd_tipoconsulta;

    if (rbtn1 == true) {
        bnd_tipoconsulta = 1;
    }

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
        bnd_tipoconsulta = 2;
    }
    if (rbtn3 == true) {
        var txt_rfc = $("#txt_rfc").val();
        if (txt_rfc == "" || /^\s+$/.test(txt_rfc)) {
            alertify.error("El campo RFC no pude estar vacio");
            return false;
        }
        bnd_tipoconsulta = 3;
    }
    if (rbtn4 == true) {
        var txt_user = $("#txt_user").val();
        if (txt_user == "" || /^\s+$/.test(txt_user)) {
            alertify.error("El campo usuario no pude estar vacio");
            return false;
        }
        bnd_tipoconsulta = 4;
    }
    if (rbtn5 == true) {
        var txt_rfc = $("#txt_rfc").val();
        if (txt_rfc == "" || /^\s+$/.test(txt_rfc)) {
            alertify.error("El campo RFC no pude estar vacio");
            return false;
        }
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
        bnd_tipoconsulta = 5;
    }
    if (rbtn6 == true) {
        var txt_user = $("#txt_user").val();
        if (txt_user == "" || /^\s+$/.test(txt_user)) {
            alertify.error("El campo usuario no pude estar vacio");
            return false;
        }
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
        bnd_tipoconsulta = 6;
    }
    alert(bnd_tipoconsulta);
    var info = "bnd_tipoconsulta=" + bnd_tipoconsulta + "&fecha_inicial=" + fecha_inicial + "&fecha_final=" + fecha_final + "&txt_rfc=" + txt_rfc + "&txt_user=" + txt_user;
    alert(info);
    $("#mostrardatosconsulta").load("buscarDatosConsulta.php?bnd_tipoconsulta=" + bnd_tipoconsulta + "&fecha_inicial=" + fecha_inicial + "&fecha_final=" + fecha_final + "&txt_rfc=" + txt_rfc + "&txt_user=" + txt_user, function () {

    });

});
