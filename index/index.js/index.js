$(document).ready(function() {
    $('.dropdown-toggle').dropdown();
    $('.dropdown-menu').find('form').click(function(e) {
        e.stopPropagation();
    });
});

$("#loginbtn").click(function() {
    var usuario = $("#loginuser").val();
    var pass = $("#loginpass").val();

    var info = "usuario=" + usuario + "&pass=" + pass;
    $.get('iniciarSesion.php', info, function(respuesta) {

    });
});