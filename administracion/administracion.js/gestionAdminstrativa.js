function entroMarca() {
    $("#1").addClass("active");
    $("#2").removeClass("active");
    $("#3").removeClass("active");
    $("#4").removeClass("active");
    $("#5").removeClass("active");
    $("#7").removeClass("active");
    $("#8").removeClass("active");
    $("#mostrar").load("wizMarca.php");
}
function entroProducto() {
    $("#1").removeClass("active");
    $("#2").addClass("active");
    $("#3").removeClass("active");
    $("#4").removeClass("active");
    $("#5").removeClass("active");
    $("#7").removeClass("active");
    $("#mostrar").load("wizProducto.php");
}
function entroProveedor() {
    $("#1").removeClass("active");
    $("#2").removeClass("active");
    $("#3").addClass("active");
    $("#4").removeClass("active");
    $("#5").removeClass("active");
    $("#6").removeClass("active");
    $("#7").removeClass("active");
    $("#8").removeClass("active");
    $("#mostrar").load("wizProveedor.php");
}

function entroListaPrecio() {
    $("#1").removeClass("active");
    $("#2").removeClass("active");
    $("#3").removeClass("active");
    $("#4").addClass("active");
    $("#5").removeClass("active");
    $("#7").removeClass("active");
    $("#8").removeClass("active");
    $("#mostrar").load("wizListaPrecio.php");
}

function entroEntradasProductos() {
    $("#1").removeClass("active");
    $("#2").removeClass("active");
    $("#3").removeClass("active");
    $("#4").removeClass("active");
    $("#5").addClass("active");
    $("#7").removeClass("active");
    $("#8").removeClass("active");
    $("#mostrar").load("wizEntradaProducto.php");
}

function entroSalidasProduto() {
    $("#1").removeClass("active");
    $("#2").removeClass("active");
    $("#3").removeClass("active");
    $("#4").removeClass("active");
    $("#5").removeClass("active");
    $("#7").addClass("active");
    $("#8").removeClass("active");
    $("#mostrar").load("wizSalidaProducto.php");
}

function entroUsuarios() {
    $("#1").removeClass("active");
    $("#2").removeClass("active");
    $("#3").removeClass("active");
    $("#4").removeClass("active");
    $("#5").removeClass("active");
    $("#7").removeClass("active");
    $("#8").addClass("active");
    $("#mostrar").load("wizUsuarios.php");
}
