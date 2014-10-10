$(window).scroll(function () {
    if ($(this).scrollTop() > 100) {
        $('.scrollUp').fadeIn();
    } else {
        $('.scrollUp').fadeOut();
    }
});

$(document).ready(function () {
    $('.scrollUp').click(function () {
        $("html, body").animate({scrollTop: 0}, 600);
        return false;
    });

    $.get('dondeInicie.php', function (x) {
        var i = $.parseJSON(x);
        var sucursal = i.donde.sucursal;
        var nombre = i.donde.nombre;
        if (x == 999) {
        } else {
            $("#session_nombre").text("Bienvenido(a): " + nombre);
            $("#session_sucursal").text(sucursal);
        }
    });
});

function entroAdministradores() {
    $("#mostrar").load("wizsu_administradores.php");
}

