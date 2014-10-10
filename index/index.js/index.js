$(document).ready(function() {
    $('.dropdown-toggle').dropdown();
    $('.dropdown-menu').find('form').click(function(e) {
        e.stopPropagation();
    });
    $("#mostrarslide").load("mostrarSlide.php", function() {
        $("#slides").slidesjs({
            width: 900,
            height: 300,
            navigation: false,
            play: {
                active: false,
                effect: "slide",
                interval: 4000,
                auto: true,
                swap: false,
                pauseOnHover: true,
                restartDelay: 2500
            }
        });
    });
    $("#mostrarcategorias").load("mostrarCategorias.php", function () {
    });
    $("#mostrarnovedades").load("mostrarNovedades.php", function() {
    });
    $("#mostrarrecomendados").load("mostrarRecomendados.php", function() {
    });
});

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
                    document.location.href = '../administracion/gestionSuperAdministrativa.php';
                }
                if (respuesta == 2) {
                    $("#loginuser").val("");
                    $("#loginpass").val("");
                    document.location.href = '../administracion/gestionAdministrativa.php';
                }
                if (respuesta == 3) {
                    $("#loginuser").val("");
                    $("#loginpass").val("");
                    document.location.href = '../administracion/gestionAdministrativaVentas.php';
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
                    document.location.href = '../administracion/gestionAdministrativaClientes.php';
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