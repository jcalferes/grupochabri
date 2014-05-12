$(document).ready(function() {
    $("#btneditaragt").hide();
});

$("#btnotrotelagt").click(function() {
    cuantostel++;
    cadena = txttel + cuantostel;
    $("#mastelsagt").append("<div id=" + cadena + " class=\"input-group\" style=\"margin-top: 10px; width: 57%;\" ><input type=\"text\" class=\"telefono form-control\"><span class=\"input-group-btn\"><button class=\"btn btn-default\" onclick='borratel(\"" + cadena + "\")' type=\"button\"><span class=\"glyphicon glyphicon-remove\"></span></button></span></div>");
    aplicarValidacion();
});