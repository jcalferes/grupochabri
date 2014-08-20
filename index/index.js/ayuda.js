$("#loginbtn").click(function() {
    var usuario = $.trim($("#loginuser").val());
    var pass = $.trim($("#loginpass").val());
    if (usuario === "" || /^\s+$/.test(usuario) || pass === "" || /^\s+$/.test(pass)) {
        $("#loginuser").val("");
        $("#loginpass").val("");
        alertify.log("Todos los campos son obligatorios");
    }
    else {
        var info = "usuario=" + usuario + "&pass=" + pass;
        $.get('iniciarSesion.php', info, function(respuesta) {
            respuesta = parseInt(respuesta);
            if (respuesta == 666) {
                alertify.error("Usuario o Contraseña invalidos");
            } else {
                if (respuesta == 1) {
                    $("#loginuser").val("");
                    $("#loginpass").val("");
                    document.location.href = '../administracion/gestionAdministrativa.php';
                }
                if (respuesta == 2) {
                    $("#loginuser").val("");
                    $("#loginpass").val("");
                    document.location.href = '../administracion/gestionAdministrativa.php';
                }
                if (respuesta == 3) {
                    $("#loginuser").val("");
                    $("#loginpass").val("");
                    alertify.success("ES UN VENDEDOR");
                }
                if (respuesta == 4) {
                    $("#loginuser").val("");
                    $("#loginpass").val("");
                    alertify.success("ES UN VENDEDOR FORANEO");
                }
                if (respuesta == 5) {
                    $("#loginuser").val("");
                    $("#loginpass").val("");
                    alertify.success("ES UN DISTRIBUIDOR");
                }
                if (respuesta == 7) {
                    $("#loginuser").val("");
                    $("#loginpass").val("");
                    alertify.success("ES UN CLIENTE");
                }
                if (respuesta == 777) {
                    $("#loginuser").val("");
                    $("#loginpass").val("");
                    alertify.error("PC no autorizada");
                }
            }
        });
    }
});