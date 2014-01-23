function entroMarca() {
    $("#1").addClass("active");
    $("#2").removeClass("active");
    $("#3").removeClass("active");
    $("#4").removeClass("active");
    $("#5").removeClass("active");
    $("#mostrar").load("wizMarca.php");
    $("#mostrar").show("slow");
}
function entroProducto() {
    $("#1").removeClass("active");
    $("#2").addClass("active");
    $("#3").removeClass("active");
    $("#4").removeClass("active");
    $("#5").removeClass("active");
    $("#mostrar").load("wizProducto.php");
    $("#mostrar").show("slow");
}
function entroProveedor() {
    $("#1").removeClass("active");
    $("#2").removeClass("active");
    $("#3").addClass("active");
    $("#4").removeClass("active");
    $("#5").removeClass("active");
    $("#mostrar").load("wizProveedor.php");
    $("#mostrar").show("slow");
}

function entroListaPrecio() {
    $("#1").removeClass("active");
    $("#2").removeClass("active");
    $("#3").removeClass("active");
    $("#4").addClass("active");
    $("#5").removeClass("active");
    $("#mostrar").load("wizListaPrecio.php");
    $("#mostrar").show("slow");
}

function entroEntradasProductos() {
    $("#1").removeClass("active");
    $("#2").removeClass("active");
    $("#3").removeClass("active");
    $("#4").removeClass("active");
    $("#5").addClass("active");
    $("#mostrar").load("wizEntradaProducto.php");
    $("#mostrar").show("slow");

}
