$(document).ready(function() {
    $("#mldProducto").click(function() {
        var interfaz = "<div class='modal-header'>" +
                "<button type='button' class='close' data-dismiss='modal' aria-hidden'true'>&times;</button>" +
                "<h4 class='modal-title' id='myModalLabel'>Modal title</h4>" +
                "</div>" +
                "<form name='guardaProducto'>" +
                "<div class='modal-body'>" +
                "</div>" +
                "</form>" +
                "<div class='modal-footer'>" +
                "<button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>" +
                "<button type='button' class='btn btn-primary'>Save changes</button>" +
                " </div>";
        $("#formulario").html(interfaz);
        $("#muestramdlproducto").click();
    });
});

