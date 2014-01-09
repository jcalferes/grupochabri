$(document).ready(function() {
    $("#btnguardar").click(function() {
        var nombre = $("#txtnombremarca").val();
        if (nombre == "") {
            alertify.log("No paso");
            return false;
        }
        else {
            alertify.success("Paso");
            return false;
        }
    });
});
