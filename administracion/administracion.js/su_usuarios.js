$(document).ready(function () {
    dt_adminactivos();
    dt_vendeactivos();
    slc_sucursal();

    $("#slctipousuario").selectpicker();


    $("#txtnombre").validCampoFranz(' abcdefghijklmnñopqrstuvwxyzáéiou1234567890@/°¬!$%&()=[]{}-_,.');//Teoricamente los simbolos permitidos para nombres y correos
    $("#txtapaterno").validCampoFranz(' abcdefghijklmnñopqrstuvwxyzáéiou1234567890@/°¬!$%&()=[]{}-_,.');
    $("#txtamaterno").validCampoFranz(' abcdefghijklmnñopqrstuvwxyzáéiou1234567890@/°¬!$%&()=[]{}-_,.');
    $("#txtemail").validCampoFranz('abcdefghijklmnñopqrstuvwxyzáéiou1234567890@/°¬!$%&()=[]{}-_,.');
    $("#txtpass").validCampoFranz('abcdefghijklmnñopqrstuvwxyzáéiou1234567890@/°¬!$%&()=[]{}-_,.');
    $("#txtpass2").validCampoFranz('abcdefghijklmnñopqrstuvwxyzáéiou1234567890@/°¬!$%&()=[]{}-_,.');
});

function dt_adminactivos() {
    $("#loadadminactivos").load("su_dtadminactivos.php", function () {
        $("#dtadminactivos").dataTable();
    });
}

function dt_vendeactivos() {
    $("#loadvendeactivos").load("su_dtvendeactivos.php", function () {
        $("#dtvendeactivos").dataTable();
    });
}

function slc_sucursal() {
    $("#slcsucursal").load("mostrarSucursales.php", function () {
        $("#slcsucursal").selectpicker();
    });
}

function eliminarAdministrador(id) {
    var id = id;
    alert("Admin");

}

function eliminarVendedor(id) {
    var id = id;
    alert("Vendedor");
}

$("#btnregistrar").click(function () {
    $('#btnregistrar').attr("disabled", true);

    var nombre = $.trim($("#txtnombre").val());
    var apaterno = $.trim($("#txtapaterno").val());
    var amaterno = $.trim($("#txtamaterno").val());
    var tipousuario = $.trim($("#slctipousuario").val());
    var sucursal = $.trim($("#slcsucursal").val());
    var usuario = $.trim($("#txtusuario").val());
    var pass = $.trim($("#txtpass").val());
    var pass2 = $.trim($("#txtpass2").val());


    if (nombre === "" || /^\s+$/.test(nombre) || apaterno === "" || /^\s+$/.test(apaterno) || amaterno === "" || /^\s+$/.test(amaterno) || tipousuario == 0 || sucursal == 0 || usuario === "" || /^\s+$/.test(usuario) || pass === "" || /^\s+$/.test(pass) || pass2 === "" || /^\s+$/.test(pass2)) {
        alertify.error("Hay un campo vacío o no seleccionaste un tipo usuario o sucursal");
        $('#btnregistrar').attr("disabled", false);
        return false;
    }

    $(".validasimbol").each(function () {
        var valor = $.trim($(this).val());
        if (valor.match(/[#\*:"<>?|';]+/) === null)
        {
        } else {
            $(this).focus();
            alertify.error("El campo no puede contener ninguno de los siguientes caracteres: #\*:\"<>?|';");
            $('#btnregistrar').attr("disabled", false);
            return false;
        }
    });

    if (pass === pass2) {
    } else {
        alertify.error("Los passwords no coinciden");
        $('#btnregistrar').attr("disabled", false);
        return false;
    }


    var data = new FormData();

    data.append('nombre', nombre);
    data.append('apaterno', apaterno);
    data.append('amaterno', amaterno);
    data.append('tipousuario', tipousuario);
    data.append('usuario', usuario);
    data.append('pass', pass2);
    data.append('sucursal', sucursal);

    $.ajax({
        url: 'su_guardarusuario.php', //Url a donde la enviaremos
        type: 'POST', //Metodo que usaremos
        contentType: false, //Debe estar en false para que pase el objeto sin procesar
        data: data, //Le pasamos el objeto que creamos con los archivos
        processData: false, //Debe estar en false para que JQuery no procese los datos a enviar
        cache: false //Para que el formulario no guarde cache
    }).done(function (call) {
        if (call == 1 || call == 666) {
            if (call == 1) {
                dt_adminactivos();
                dt_vendeactivos();

                $("#txtnombre").val("");
                $("#txtapaterno").val("");
                $("#txtamaterno").val("");
                $("#slctipousuario").selectpicker('val', 0);
                $("#slcsucursal").selectpicker('val', 0);
                $("#txtusuario").val("");
                $("#txtpass").val("");
                $("#txtpass2").val("");

                alertify.success("Usuario correctamente registrado");
            }
            if (call == 666) {
                alertify.error("El nombre de usuario ya esta en uso");
            }
        } else {
            alertify.alert("ERROR: " + call);
        }
        $('#btnregistrar').attr("disabled", false);
    });


});