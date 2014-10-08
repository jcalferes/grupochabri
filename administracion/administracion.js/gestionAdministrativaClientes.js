var codigoAleatorio;


$(window).scroll(function () {
    if ($(this).scrollTop() > 100) {
        $('.scrollUp').fadeIn();
    } else {
        $('.scrollUp').fadeOut();
    }
});


function actualizarTelefono() {
    if ($("#cmbTelefonos").val() == 0) {
        alertify.error("Seleccione un telefono para editar");
    }
    else {
        var valor = $('#cmbTelefonos option:selected').html();
        $("#txtTelefono").val(valor);
        $("#cmbTelefonos").slideUp('slow');
        $("#txtTelefono").slideDown("slow");
        $("#btnActualizarTelefono").slideDown('slow');
        $("#btnCancelarTelefono").slideDown('slow');
        $("#btnEditarTelefono").hide();
        $("#txtCodigo").hide();
        $("#btnActualizarCon").hide();
    }
}


function actualizarCorreos() {
    if ($("#cmbCorreos").val() == 0) {
        alertify.error("Seleccione un correo para editar");
    }
    else {
        var valor = $('#cmbCorreos option:selected').html();
        $("#txtCorreos").val(valor);
        $("#cmbCorreos").slideUp('slow');
        $("#txtCorreos").slideDown("slow");
        $("#btnActualizarCorreo").slideDown('slow');
        $("#btnCancelarCorreo").slideDown('slow');
        $("#btnEditarCorreo").hide();
        $("#txtCodigo").hide();
        $("#btnActualizarCon").hide();
    }
}





function guardarActualizacionTelefono() {
    if ($("#txtTelefono").val() == "") {
        alertify.error("Se requiere un telefono");
    }
    else {
        var nuevoTelefono = $("#txtTelefono").val();
        var id = $("#cmbTelefonos").val();
        var info = "idTelefono=" + id + "&telefono=" + nuevoTelefono;
        $.get("actualizarTelefono.php", info, function (respuesta) {
            $("#contenidoPerfil").load("dameInformacionPerfil.php", function () {
                $("#mdlPerfil").modal("show");
                $("#txtTelefono").hide();
                $("#btnActualizarTelefono").hide();
                $("#btnCancelarTelefono").hide();
                $("#txtCorreos").hide();
                $("#btnActualizarCorreo").hide();
                $("#btnCancelarCorreo").hide();
                $("#txtCodigo").hide();
                $("#btnActualizarCon").hide();
                $("#txtNuevaContraseña").hide();
                $("#btnGuardarNuevaConta").hide();
                alertify.success(respuesta);
            });
        });
    }
}



function guardarActualizacionCorreo() {
    if ($("#txtCorreos").val() == "") {
        alertify.error("Se requiere un telefono");
    }
    else {
        var nuevoTelefono = $("#txtCorreos").val();
        var id = $("#cmbCorreos").val();
        var info = "idCorreo=" + id + "&correo=" + nuevoTelefono;
        $.get("actualizarCorreo.php", info, function (respuesta) {
            $("#contenidoPerfil").load("dameInformacionPerfil.php", function () {
                $("#mdlPerfil").modal("show");
                $("#txtTelefono").hide();
                $("#btnActualizarTelefono").hide();
                $("#btnCancelarTelefono").hide();
                $("#txtCorreos").hide();
                $("#btnActualizarCorreo").hide();
                $("#btnCancelarCorreo").hide();
                $("#txtCodigo").hide();
                $("#btnActualizarCon").hide();
                $("#txtNuevaContraseña").hide();
                $("#btnGuardarNuevaConta").hide();
                alertify.success(respuesta);
            });
        });
    }
}


function cambiarPass() {

    if ($("#cmbCorreos").val() == 0) {
        alertify.error("Seleccione un correo a donde enviara el codigo");
    }
    else {
        $("#lnkGenerarPass").slideUp('slow');
        $("#txtCodigo").slideDown("slow");
        $("#btnActualizarCon").slideDown("slow");
        var correo = $('#cmbCorreos option:selected').html();
        var informacion = "correo=" + correo;
        $.get("generarCodigoAleatorio.php", informacion, function (respuesta) {
            codigoAleatorio = respuesta;
            alert(respuesta);
            alertify.success("Correo enviado al correo: " + correo);
        });
    }
}

function actualizarContras() {
    var codigo = $("#txtCodigo").val();
    if (codigo == codigoAleatorio) {
        $("#txtNuevaContraseña").slideDown('slow');
        $("#btnGuardarNuevaConta").slideDown('slow');
        $("#txtCodigo").slideUp("slow");
        $("#btnActualizarCon").slideUp("slow");
        alertify.success("Contraseña Verificada");
    }
    else {
        alertify.error("Error. Codigo erroneo Verifica tu correo");
    }
}


function guardarNuevaContra() {
    var valor = $("#txtNuevaContraseña").val();
    if (valor == "") {
        alertify.error("Se requiere una nueva Contraseña");
    }
    else {
        var info = "contra=" + valor;
        $.get("nuevaContra.php", info, function (respuesta) {
            alertify.success(respuesta);
            $("#mdlPerfil").modal("hide");
        });
    }
}

$(document).ready(function () {

    $("#perfil").click(function () {
        $("#contenidoPerfil").load("dameInformacionPerfil.php", function () {
            $("#mdlPerfil").modal("show");
            $("#txtTelefono").hide();
            $("#btnActualizarTelefono").hide();
            $("#btnCancelarTelefono").hide();
            $("#btnActualizarCorreo").hide();
            $("#btnCancelarCorreo").hide();
            $("#txtCorreos").hide();
            $("#txtCodigo").hide();
            $("#btnActualizarCon").hide();
            $("#txtNuevaContraseña").hide();
            $("#btnGuardarNuevaConta").hide();
        });
    });

    $('.scrollUp').click(function () {
        $("html, body").animate({scrollTop: 0}, 600);
        return false;
    });

    $.get('dondeInicie.php', function (x) {
        var i = $.parseJSON(x);
        var sucursal = i.donde.sucursal;
        var nombre = i.donde.nombre;
        if (x == 999) {
        } else {
            $("#session_nombre").text("Bienvenido(a): " + nombre);
            $("#session_sucursal").text(sucursal);
        }
    });
});

//$("#donde").click(function(){
//    alert("Entre");
//});

function entroMarca() {
    $("#mostrar").load("wizMarca.php");
}
function entroProducto() {

    $("#mostrar").load("wizProducto.php");
}
function entroProveedor() {
    $("#mostrar").load("wizProveedor.php");
}
function entroListaPrecio() {
    $("#mostrar").load("wizListaPrecio.php");
}
function entroEntradasProductos() {
    $("#mostrar").load("wizEntradaProducto.php");
}
function entroSalidasProduto() {
    $("#mostrar").load("wizSalidaProducto.php");
}

function entroUsuarios() {
    $("#mostrar").load("wizUsuarios.php");
}
function entroCliente() {
    $("#mostrar").load("wizClientes.php");
}

function entroVentas() {
    $("#mostrar").load("wizVentas.php");
}

function entroTrasferencia() {
    $("#mostrar").load("wizTransferencia.php");
}

function ordenCompra() {

    $("#mostrar").load("wizOrdenCompra.php");
}

function entroAgranel() {
    $("#mostrar").load("wizAgranel.php");
}

function entroClientePedido() {
    $("#mostrar").load("wizClientePedido.php");
}

function entroClasificados() {
    $("#mostrar").load("wizClasificados.php");
}

function cambiarSucursal() {
    $("#slccamsuc").load("sacarSucursales.php", function () {
        $('#slccamsuc').selectpicker();
        ;
    });
    $("#mdlcamsuc").modal('show');
}

$("#btncamsuc_cancelar").click(function () {

});

$("#btncamsuc_cambiar").click(function () {
    var n_suc = $("#slccamsuc").val();
    if (n_suc != 0) {
        var info = "nsuc=" + n_suc;
        $.get('cambiarSucursalSession.php', info, function (r) {
            if (r == true) {
                document.location.href = '../administracion/gestionAdministrativaClientes.php';
            } else {
                alertify.error("No se pudo cambiar la session");
            }
        });
    } else {
        alertify.error("Seleccione una sucursal.");
    }
});
