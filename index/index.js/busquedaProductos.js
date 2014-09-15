




$(document).ready(function () {
    $('.dropdown-menu').find('form').click(function (e) {
        e.stopPropagation();
    });

    $("#btnBusquedaProductos").click(function () {
        var callbacks = $.Callbacks();
        var busqueda = "";
        callbacks.add(busqueda = $("#txtBusquedaProductosIndex").val());
        callbacks.add($("#panelBusquedaProductos").hide());
        callbacks.add($("#panelBusquedaProductos").load("mostrarProductosBuscador.php?buscar=" + busqueda, function () {
            $("#panelBusquedaProductos").slideDown("slow");
        }));
    });


    $("#txtBusquedaProductosIndex").keypress(function (e) {
        if (e.which == 13) {
            var callbacks = $.Callbacks();
            var busqueda = "";
            callbacks.add(busqueda = $("#txtBusquedaProductosIndex").val());
            callbacks.add($("#panelBusquedaProductos").hide());
            callbacks.add($("#panelBusquedaProductos").load("mostrarProductosBuscador.php?buscar=" + busqueda, function () {
                $("#panelBusquedaProductos").slideDown("slow");
            }));
        }
    });




});
function mostrarPaginaB(i) {
//        alert("entra");
    var pag = i - 1;
    $('#tbCachibachesB').find(".cachibaches").each(function () {
        var elemento = this;
        elemento.style.display = "none";
    });

    $('#tbCachibachesB').find(".pag" + pag).each(function () {
        var elemento = this;
        elemento.style.display = "";
    });
}