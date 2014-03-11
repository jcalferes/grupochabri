$(document).ready(function() {
    $("#selectTipoUsuario").load("mostrarTipoUsuario.php", function() {
        $("#selectTipoUsuario").selectpicker();
    });
});
$("#btnusuario").click(function() {
    var tipousuario = $("#selectTipoUsuario").val();
    if (tipousuario == 0) {
        alertify.error("No seleccionaste un tipo de usuario");
        return false;
    }

    var usuario = $.trim($("#txtusuario").val().toUpperCase());
    var nombre = $.trim($("#txtnombre").val().toUpperCase());
    var paterno = $.trim($("#txtpaterno").val().toUpperCase());
    var materno = $.trim($("#txtmaterno").val().toUpperCase());
    var pass = $.trim($("#txtpass").val().toUpperCase());
    var repass = $.trim($("#txtrepass").val().toUpperCase());

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
    var info = "usuario=" + usuario + "&nombre=" + nombre + "&paterno=" + paterno + "&materno=" + materno + "$pass=" + pass;
    $.get("", info, function(respuesta) {

    });
});