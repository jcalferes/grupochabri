$(document).ready(function() {
    $("#selectTipoUsuario").load("mostrarTipoUsuario.php", function() {
        $("#selectTipoUsuario").selectpicker();
        $("#diveditarusuario").hide();
    });
});
$("#txtusuario").keyup(function() {
    var usuario = $.trim($("#txtusuario").val());
    var info = "usuario=" + usuario;
    $.get('verificandoUsuario.php', info, function(respuesta) {
        if (respuesta < 1) {
            $('#selectTipoUsuario').selectpicker('val', 0);
            $("#txtnombre").val("");
            $("#txtpaterno").val("");
            $("#txtmaterno").val("");
            $("#diveditarusuario").slideUp();
            $("#divguardarusuario").slideDown();
            return false;
        } else {
            datos = JSON.parse(respuesta);
            $.each(datos, function(indice, elemento) {
                if (indice == "idUsuario") {
                    $('#txtid').val(elemento);
                }
                if (indice == "idtipousuario") {
                    $('#selectTipoUsuario').selectpicker('val', elemento);
                }
                if (indice == "nombre") {
                    $("#txtnombre").val(elemento);
                }
                if (indice == "apellidoPaterno") {
                    $("#txtpaterno").val(elemento);
                }
                if (indice == "apellidoMaterno") {
                    $("#txtmaterno").val(elemento);
                }
            });
            $("#divguardarusuario").slideUp();
            $("#diveditarusuario").slideDown();
        }
    });
});
$("#btnguardarusuario").click(function() {
    var tipousuario = $("#selectTipoUsuario").val();
    var usuario = $.trim($("#txtusuario").val);
    var nombre = $.trim($("#txtnombre").val().toUpperCase());
    var paterno = $.trim($("#txtpaterno").val().toUpperCase());
    var materno = $.trim($("#txtmaterno").val().toUpperCase());
    var pass = $.trim($("#txtpass").val().toUpperCase());
    var repass = $.trim($("#txtrepass").val().toUpperCase());

    if (tipousuario == 0) {
        alertify.error("No seleccionaste un tipo de usuario");
        return false;
    }

    if (usuario === "" || /^\s+$/.test(usuario) || nombre === "" || /^\s+$/.test(nombre) || paterno === "" || /^\s+$/.test(paterno) || materno === "" || /^\s+$/.test(materno) || pass === "" || /^\s+$/.test(pass || repass === "" || /^\s+$/.test(repass))) {
        $("#frmpass").removeClass("has-error");
        $("#frmrepass").removeClass("has-error");
        $("#frmpass").removeClass("has-success");
        $("#frmrepass").removeClass("has-success");
        alertify.error("Todos los campos son obligatorios");
        return false;
    }

    if (pass !== repass) {
        $("#frmpass").removeClass("has-success");
        $("#frmrepass").removeClass("has-success");
        $("#frmpass").addClass("has-error");
        $("#frmrepass").addClass("has-error");
        alertify.error("Los passwords no coinciden");
        return false;
    } else {
        $("#frmpass").removeClass("has-error");
        $("#frmrepass").removeClass("has-error");
        $("#frmpass").addClass("has-success");
        $("#frmrepass").addClass("has-success");
    }

    var info = "tipousuario=" + tipousuario + "&usuario=" + usuario + "&nombre=" + nombre + "&paterno=" + paterno + "&materno=" + materno + "&pass=" + pass;
    $.get("guardarUsuario.php", info, function(respuesta) {
        alert(respuesta);
        if (respuesta == 1) {
            alertify.error("Error al guardar");
        }
        if (respuesta == 0) {
            alertify.success("Bien");
            $('#selectTipoUsuario').selectpicker('val', 0);
            $("#txtusuario").val("");
            $("#txtnombre").val("");
            $("#txtpaterno").val("");
            $("#txtmaterno").val("");
            $("#txtpass").val("");
            $("#txtrepass").val("");
        }
    });
});
$("#btneditarusuario").click(function() {
    var id = $("#txtid").val();
    alert(id);
    var tipousuario = $("#selectTipoUsuario").val();
    var usuario = $.trim($("#txtusuario").val());
    var nombre = $.trim($("#txtnombre").val().toUpperCase());
    var paterno = $.trim($("#txtpaterno").val().toUpperCase());
    var materno = $.trim($("#txtmaterno").val().toUpperCase());
    var pass = $.trim($("#txtpass").val().toUpperCase());
    var repass = $.trim($("#txtrepass").val().toUpperCase());
    alert(usuario);
    if (tipousuario == 0) {
        alertify.error("No seleccionaste un tipo de usuario");
        return false;
    }

    if (usuario === "" || /^\s+$/.test(usuario) || nombre === "" || /^\s+$/.test(nombre) || paterno === "" || /^\s+$/.test(paterno) || materno === "" || /^\s+$/.test(materno) || pass === "" || /^\s+$/.test(pass || repass === "" || /^\s+$/.test(repass))) {
        $("#frmpass").removeClass("has-error");
        $("#frmrepass").removeClass("has-error");
        $("#frmpass").removeClass("has-success");
        $("#frmrepass").removeClass("has-success");
        alertify.error("Todos los campos son obligatorios");
        return false;
    }

    if (pass !== repass) {
        $("#frmpass").removeClass("has-success");
        $("#frmrepass").removeClass("has-success");
        $("#frmpass").addClass("has-error");
        $("#frmrepass").addClass("has-error");
        alertify.error("Los passwords no coinciden");
        return false;
    } else {
        $("#frmpass").removeClass("has-error");
        $("#frmrepass").removeClass("has-error");
        $("#frmpass").addClass("has-success");
        $("#frmrepass").addClass("has-success");
    }
    var info = "id=" + id + "&tipousuario=" + tipousuario + "&usuario=" + usuario + "&nombre=" + nombre + "&paterno=" + paterno + "&materno=" + materno + "&pass=" + pass;
    $.get("editarUsuario.php", info, function(respuesta) {

    });
});
$("#btneliminarusuario").click(function() {


});