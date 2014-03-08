$(document).ready(function() {
    $('.dropdown-toggle').dropdown();
    $('.dropdown-menu').find('form').click(function(e) {
        e.stopPropagation();
    });
});

$("#loginbtn").click(function() {
    var usuario = $.trim($("#loginuser").val());
    var pass = $.trim($("#loginpass").val());

    if (usuario === "" || /^\s+$/.test(usuario) || pass === "" || /^\s+$/.test(pass)) {
        $("#loginuser").val("");
        $("#loginpass").val("");
        alertify.log("Todos los campos son obligatorios");

    } else {
        var info = "usuario=" + usuario + "&pass=" + pass;
        $.get('iniciarSesion.php', info, function(respuesta) {
            if (respuesta == 1) {
                alertify.error("Usuario o Contraseña invalidos");
            } else {
                alertify.success("Bien");
                $("#loginuser").val("");
                $("#loginpass").val("");
            }
        });
    }
});