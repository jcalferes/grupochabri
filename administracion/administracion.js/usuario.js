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
    var usuario = $("#txtusuario").val();

//    $("#frmpass").addClass("has-success");
//    $("#frmrepass").addClass("has-success");

});