function entroMarca() {
    $("#1").addClass("active");
    $("#2").removeClass("active");
    $("#3").removeClass("active");
    $("#4").removeClass("active");
    $("#5").removeClass("active");
    $("#6").removeClass("active");
    $("#mostrar").load("wizMarca.php");

}
function entroProducto() {
    $("#1").removeClass("active");
    $("#2").addClass("active");
    $("#3").removeClass("active");
    $("#4").removeClass("active");
    $("#5").removeClass("active");
    $("#6").removeClass("active");
    $("#mostrar").load("./producto/wizProducto.php");
}
function entroProveedor() {
    $("#1").removeClass("active");
    $("#2").removeClass("active");
    $("#3").addClass("active");
    $("#4").removeClass("active");
    $("#5").removeClass("active");
    $("#6").removeClass("active");
    $("#mostrar").load("./proveedor/wizProveedor.php");
}

function entroListaPrecio() {
    $("#1").removeClass("active");
    $("#2").removeClass("active");
    $("#3").removeClass("active");
    $("#4").addClass("active");
    $("#5").removeClass("active");
    $("#6").removeClass("active");
    $("#mostrar").load("./listaPrecio/wizListaPrecio.php");
}

function entroEntradasProductos() {
    $("#1").removeClass("active");
    $("#2").removeClass("active");
    $("#3").removeClass("active");
    $("#4").removeClass("active");
    $("#5").addClass("active");
    $("#6").removeClass("active");
    $("#mostrar").load("./entradasInventario/wizEntradaProducto.php");
}
function entroTarifas() {
    $("#1").removeClass("active");
    $("#2").removeClass("active");
    $("#3").removeClass("active");
    $("#4").removeClass("active");
    $("#5").removeClass("active");
    $("#6").addClass("active");
    $("#mostrar").load("./tarifa/wizTarifas.php");
}
