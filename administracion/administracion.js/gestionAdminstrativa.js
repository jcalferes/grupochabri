function entroMarca() {
    $("#1").addClass("active");
    $("#2").removeClass("active");
    $("#3").removeClass("active");
    $("#4").removeClass("active");
    $("#5").removeClass("active");
    $("#7").removeClass("active");
    $("#8").removeClass("active");
    $("#mostrar").load("wizMarca.php");
    $("#9").removeClass("active");
}
function entroProducto() {
    $("#1").removeClass("active");
    $("#2").addClass("active");
    $("#3").removeClass("active");
    $("#4").removeClass("active");
    $("#5").removeClass("active");
    $("#7").removeClass("active");
    $("#mostrar").load("wizProducto.php");
    $("#9").removeClass("active");
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
    $("#9").removeClass("active");
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
    $("#9").removeClass("active");
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
    $("#9").removeClass("active");
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
    $("#9").removeClass("active");
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
    $("#9").removeClass("active");
}
function entroCliente() {
    $("#1").removeClass("active");
    $("#2").removeClass("active");
    $("#3").removeClass("active");
    $("#4").removeClass("active");
    $("#5").removeClass("active");
    $("#7").removeClass("active");
    $("#8").removeClass("active");
    $("#mostrar").load("wizClientes.php");
    $("#9").addClass("active");
}

function entroVentas() {
    $("#1").removeClass("active");
    $("#2").removeClass("active");
    $("#3").removeClass("active");
    $("#4").removeClass("active");
    $("#5").removeClass("active");
    $("#7").removeClass("active");
    $("#8").removeClass("active");
    $("#mostrar").load("puntoDeVenta.php");
    $("#10").addClass("active");
}
