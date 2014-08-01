//============ UTILIDADES ======================================================
function NumCheck(e, field, tarifa) {
    key = e.keyCode ? e.keyCode : e.which
    if (key == 15) {
        return true;
    }
    if (key > 47 && key < 58) {
        if (field.value == "") {
            return true;
        }
        regexp = /.[0-9]{20}$/;
        return !(regexp.test(field.value));
    }
    if (key == 46) {
        if (field.value == "") {
            return false;
        }
        regexp = /^[0-9]+$/;
        return regexp.test(field.value);
    }
    return false;
}

$("#txtCostoProducto").keyup(function() {
    var val_costo = $("#txtCostoProducto").val();
    if (val_costo === "" || /^\s+$/.test(val_costo)) {
        val_costo = 0;
    } else {
        val_costo = $("#txtCostoProducto").val();
    }
    $("#tablaListaPrecios").find(':checked').each(function() {
        var elemento = this;
        var valor = elemento.value;
        var uti = $("#texto" + valor).val();
        uti = uti / 100;
        if (uti <= 0) {
            var resultado = val_costo;
            $("#tarifa" + valor).val(resultado.toFixed(2));
        } else {
            var resultado = val_costo * uti;
            $("#util" + valor).val(resultado.toFixed(2));
            resultado = parseFloat(resultado) + parseFloat(val_costo);

            $("#tarifa" + valor).val(resultado.toFixed(2));
        }
    });
});

function tester(valor) {
    var costo = document.getElementById("txtCostoProducto").value;
    if ($("#check" + valor).is(':checked')) {
        $("#texto" + valor).attr("disabled", false);
        $("#texto" + valor).val(0);
        $("#tarifa" + valor).val(costo);
    } else {
        $("#texto" + valor).attr("disabled", true);
        $("#tarifa" + valor).val("");
        $("#texto" + valor).val("");
        $("#util" + valor).val("");
    }
}

function obtenerUtilidad(utilidad) {
    var costo = document.getElementById("txtCostoProducto").value;
    var utilidades = $("#texto" + utilidad).val();
    utilidades = utilidades / 100;
    var tarifa = costo * utilidades;
    $("#util" + utilidad).val(tarifa);
    tarifa = parseFloat(costo) + parseFloat(tarifa);
    $("#tarifa" + utilidad).val(tarifa);
}

function obtenerUtilidadCosto() {
    var costo = document.getElementById("txtCostoProducto").value;
    if (costo !== "") {
        $(":checkbox").attr("disabled", false);
    } else {
//        $("#txtCostoProducto").val(0);
//        $(".producto").attr("disabled", true);
//        $(".checando").attr("checked", false);
//        $(":checkbox").attr("disabled", true);
    }
    $("#tablaListaPrecios").find(':checked').each(function() {
        var elemento = this;
        var valor = elemento.value;
        var uti = $("#texto" + valor).val();
        var resultado = 0;
        uti = uti / 100;
        if (uti <= 0) {
            resultado = costo;
            $("#tarifa" + valor).val(resultado);
        } else {
            resultado = costo * uti;
            $("#util" + valor).val(resultado);
            resultado = parseFloat(resultado) + parseFloat(costo);

            $("#tarifa" + valor).val(resultado);
        }
    });
}

$(document).ready(function() {
    $("#limpiargranel").hide();
    $("#guardarGranel").hide();
    $("#editarGranel").hide();
    $("#frmcodgranel").hide();
    $("#frmcontenido").hide();
    $("#frmcostopieza").hide();
    $("#editarDatos").hide();
    $("#divm3").hide();
    $('#txtCodigoProducto').validCampoFranz('abcdefghijklmnñopqrstuvwxyzáéiou1234567890°!#$%&/()=?¡|¬?*´+~{}[]-_.:,;');
    $('#txtNombreProducto').validCampoFranz(' abcdefghijklmnñopqrstuvwxyzáéiou1234567890°!#$%&/()=?¡|¬?*´+~{}[]-_.:,;');
    $("#tablaListaPrecios").load("consultarTarifas.php");
    $('#checarListas').hide();
    $("#consultaProducto").load("consultarProducto.php", function() {
        $("#tdProducto").dataTable();
    });
    $("#selectMarca").load("mostrarMarcas.php", function() {
        $("#selectMarca").selectpicker();
    });
    $("#selectGrupo").load("mostrarGrupos.php", function() {
        $("#selectGrupo").selectpicker();
    });
    $("#selectProveedor").load("mostrarProveedores.php", function() {
        $("#selectProveedor").selectpicker();
    });
    $("#selectMedida").load("mostrarUnidadesMedida.php", function() {
        $("#selectMedida").selectpicker();
    });
    $("#mostrarDivProveedor").hide("slow");
    $("#agregarProveedor").click(function() {
        $("#formulario").hide("slow");
        $("#mostrarDivProveedor").show("slow");
    });
    $("#btncancelarproveedor").click(function() {
        $("#mostrarDivProveedor").hide("slow");
        $("#formulario").show("slow");
        $("#txtnombreproveedor").val("");
        $("#txtrfc").val("");
        $("#txtdiascredito").val("");
        $("#txtdescuento").val("");
        $("#formulario").show("slow");
        $("#mostrarDivProveedor").hide("slow");
    });
});

$("#limpiarFormProd").click(function() {
    limpiarProductos();
});

function limpiarProductos() {
    $("#txtNombreProducto").val("");
    $("#txtCodigoBarras").val("");
    $("#txtCodigoProducto").val("");
    $('#selectMarca').selectpicker('val', 0);
    $('#selectProveedor').selectpicker('val', 0);
    $('#selectGrupo').selectpicker('val', 0);
    $('#selectMedida').selectpicker('val', 0);
    $("#txtCostoProducto").val("");
    $("#txtCantidadMinima").val("");
    $("#txtCantidadMaxima").val("");
    $("#m3").val("");
    $(".producto").val("");
    $(".neto").val("");
    $(".producto").attr("disabled", true);
    $(".checando").attr("disabled", true);
    $(".checando").attr("checked", false);
    $("#selectProducto").load("obtenerProductos.php");
    $("#guardarDatos").show();
    $("#editarDatos").hide();
    $("#finder").val("");
    $("#txtCodigoProducto").prop('disabled', false);
    $("#txtCodigoBarras").prop('disabled', false);
    $("#chkgranel").prop('disabled', false);
}
$("#finder").keypress(function(e) {
    if (e.which == 13) {
        var codigo = $("#finder").val();
        if (codigo === "" || /^\s+$/.test(codigo)) {
            $("#finder").val("");
        } else {
            var controlg = 0;
            var info = "codigoProducto=" + codigo + "&controlg=" + controlg;
            $.get('verificandoProducto.php', info, function(x) {
                if (x < 1) {
                    alertify.log("Ningun producto relacionado");
                    var codprob = $("#txtCodigoBarras").val();
                    if (codprob === "" || /^\s+$/.test(codprob)) {
                        $("#txtCodigoBarras").val("");
                    }
                    limpiarProductos();
                } else {
                    limpiarProductos();
                    var lista = JSON.parse(x);
                    console.log(lista);
                    $(".producto").attr("disabled", true);
                    $(".checando").attr({
                        checked: false,
                        disabled: false
                    });
                    $.each(lista, function(ind, elem) {
                        if (ind == "codigoBarrasProducto") {
                            $("#txtCodigoBarras").val(elem);
                        }
                        if (ind == "codigoProducto") {
                            $("#txtCodigoProducto").val(elem);
                        }
                        if (ind == "codigoBarrasProducto") {
                            $("#txtCodigoBarras").val(elem);
                        }
                        if (ind == "producto") {
                            $("#txtNombreProducto").val(elem);
                        }
                        if (ind == "idUnidadMedida") {
                            $('#selectMedida').selectpicker('val', elem);
                        }
                        if (ind == "idGrupoProducto") {
                            $('#selectGrupo').selectpicker('val', elem);
                        }
                        if (ind == "idMarca") {
                            $('#selectMarca').selectpicker('val', elem);
                        }
                        if (ind == "idProveedor") {
                            $('#selectProveedor').selectpicker('val', elem);
                        }
                        if (ind == "costo") {
                            $("#txtCostoProducto").val(elem);
                        }
                        if (ind == "cantidadMaxima") {
                            $("#txtCantidadMaxima").val(elem);
                        }
                        if (ind == "cantidadMinima") {
                            $("#txtCantidadMinima").val(elem);
                        }
                        if (ind == "metrosCubicos") {
                            $("#m3").val(elem);
                        }
                    });
                    $.get('obtenerTarifasPorConsulta.php', info, function(x) {
                        var lista = JSON.parse(x);
                        console.log(lista);
                        var provando = 0;
                        $(".producto").val("");
                        $(".producto").attr("disabled", true);
                        $.each(lista, function(indice, elemento) {
                            $.each(elemento, function(ind, elem) {
                                if (ind == 0) {
                                    provando = elem;
                                }
                                if (ind == "porcentaUtilidad") {
                                    provando = provando.replace(" ", "_")
                                    var costo = $("#txtCostoProducto").val();
                                    var utilidad = costo * (elem / 100);
                                    $("#util" + provando).val(utilidad);
                                    utilidad = parseFloat(utilidad) + parseFloat(costo);
                                    $("#texto" + provando).val(elem);
                                    $("#texto" + provando).attr("disabled", false);
                                    $("#check" + provando).prop('disabled', false);
                                    $("#check" + provando).prop('checked', true);
                                    $("#tarifa" + provando).val(utilidad);
                                    provando = 0;
                                }
                            });
                        });
                    });
                    $("#finder").val("");
                    $("#txtCodigoBarras").prop('disabled', true);
                    $("#txtCodigoProducto").prop('disabled', true);
                    $("#chkgranel").prop('disabled', true);
                    $("#guardarDatos").hide();
                    $("#editarDatos").show();
                }
            });
        }
    }
});
//=================== Guardar datos producto ===================================
$("#guardarDatos").click(function() {
    var lista;
    var nombreProducto = escape($.trim($("#txtNombreProducto").val().toUpperCase()));
    var marca = $("#selectMarca").val();
    var proveedor = $("#selectProveedor").val();
    var codigoProducto = $("#txtCodigoProducto").val();
    var costoProducto = parseFloat($("#txtCostoProducto").val());
    var min = parseFloat($("#txtCantidadMinima").val());
    var max = $("#txtCantidadMaxima").val();
    var unidadMedida = $("#selectMedida").val();
    var grupoProducto = $("#selectGrupo").val();
    var cbarras = $("#txtCodigoBarras").val();

    var seleccion = document.getElementById('selectGrupo');
    var dato2 = seleccion.options[seleccion.selectedIndex].text;

    var listaPrecios = new Array();
    var listaTarifas = new Array();
    //Estas variabless solo estan para que no marque error granel===========
    var original = 0;
    var contenido = 0;
    var granel = 0;
    //======================================================================

    $("#tablaListaPrecios").find('.producto').each(function() {
        var elemento = this;
        var nombre = elemento.name;
        var valor = elemento.value;
        if (valor !== "") {
            if (valor !== " ") {
                if (valor !== null) {
                    var algo = valor + "-" + nombre;
                    listaPrecios.push(algo);
                    lista = JSON.stringify(listaPrecios);
                    valor = "";
                    nombre = "";
                } else {
                }
            } else {
            }

        } else {
        }
    });
    if (cbarras !== "" && nombreProducto !== "" && marca !== "" && proveedor !== "" && codigoProducto !== "" && costoProducto !== "" && lista !== "" && min !== "" && max !== "" && lista !== " " && lista !== null && lista !== undefined && unidadMedida !== "" && grupoProducto !== "" && marca !== "0" && proveedor !== "0" && grupoProducto !== "0" && unidadMedida !== "0" && unidadMedida !== "0") {
        if (min < max) {
            if (grupoProducto == 1 || dato2 == 'MADERAS') {
                var m3 = $("#m3").val();
                if (m3 === "" || /^\s+$/.test(m3)) {
                    alertify.error("Faltan los metros cubicos del producto");
                    return false;
                }
            } else {
                m3 = 0;
            }

            var info = "producto=" + nombreProducto + "&cbarras=" + cbarras + "&marca=" + marca + "&proveedor=" + proveedor + "&codigoProducto=" + codigoProducto + "&costoProducto=" + costoProducto + "&lista=" + lista + "&min=" + min + "&max=" + max + "&grupoProducto=" + grupoProducto + "&unidadMedida=" + unidadMedida + "&granel=" + granel + "&contenido=" + contenido + "&original=" + original + "&m3=" + m3;
            $.get('guardarProducto.php', info, function(x) {
                if (x >= 1) {
                    $("#consultaProducto").load("consultarProducto.php", function() {
                        $("#tdProducto").dataTable();
                    });
                    $("#txtNombreProducto").val("");
                    $("#txtCodigoBarras").val("");
                    $("#txtCodigoProducto").val("");
                    $('#selectMarca').selectpicker('val', 0);
                    $('#selectProveedor').selectpicker('val', 0);
                    $('#selectGrupo').selectpicker('val', 0);
                    $('#selectMedida').selectpicker('val', 0);
                    $("#txtCostoProducto").val("");
                    $("#txtCantidadMinima").val("");
                    $("#txtCantidadMaxima").val("");
                    $(".producto").val("");
                    $(".neto").val("");
                    $(".producto").attr("disabled", true);
                    $(".checando").attr("checked", false);
                    $("#selectProducto").load("obtenerProductos.php");
                    alertify.success("Producto agregado correctamente");
                    return false;
                } else {
                    $("#consultaProducto").load("consultarProducto.php", function() {
                        $("#tdProducto").dataTable();
                    });
                    $("#txtNombreProducto").val("");
                    $("#txtCodigoBarras").val("");
                    $("#txtCodigoProducto").val("");
                    $('#selectMarca').selectpicker('val', 0);
                    $('#selectProveedor').selectpicker('val', 0);
                    $('#selectGrupo').selectpicker('val', 0);
                    $('#selectMedida').selectpicker('val', 0);
                    $("#txtCostoProducto").val("");
                    $("#txtCantidadMinima").val("");
                    $("#txtCantidadMaxima").val("");
                    $(".producto").val("");
                    $(".neto").val("");
                    $(".producto").attr("disabled", true);
                    $(".checando").attr("checked", false);
                    $("#selectProducto").load("obtenerProductos.php");
                    alertify.error("Este producto ya fue agregado");
                }
            });
        } else {
            alertify.error("La cantidad maxima debe ser mayor a la minima");
        }
    } else {
        alertify.error("Todos los campos deben tener valor");
    }
});
//================ Editar producto =============================================
$('#editarDatos').click(function() {
    var dato2 = $("#selectGrupo").val();
    if (dato2 == 1) {
        dato2 = "MADERAS";
    }
    var lista;
    var nombreProducto = escape($.trim($("#txtNombreProducto").val().toUpperCase()));
    var marca = $("#selectMarca").val();
    var proveedor = $("#selectProveedor").val();
    var codigoProducto = $("#txtCodigoProducto").val();
    var costoProducto = $("#txtCostoProducto").val();
    var min = parseFloat($("#txtCantidadMinima").val());
    var max = $("#txtCantidadMaxima").val();
    var unidadMedida = $("#selectMedida").val();
    var grupoProducto = $("#selectGrupo").val();
    var listaPrecios = new Array();
    var listaTarifas = new Array();
    $("#tablaListaPrecios").find('.producto').each(function() {
        var elemento = this;
        var nombre = elemento.name;
        var valor = elemento.value;
        var algo = valor + "-" + nombre;
        listaPrecios.push(algo);
        lista = JSON.stringify(listaPrecios);
        valor = "";
        nombre = "";
    });
    if (nombreProducto !== "" && marca !== "" && proveedor !== "" && codigoProducto !== "" && costoProducto !== "" && lista !== "" && min !== "" && max !== "" && lista !== " " && lista !== null && lista !== undefined && unidadMedida !== "" && grupoProducto !== "" && marca !== "0" && proveedor !== "0" && grupoProducto !== "0" && unidadMedida !== "0" && unidadMedida !== "0") {
        if (min < max) {
            if (grupoProducto == 1 || dato2 == 'MADERAS') {
                var m3 = $("#m3").val();
                if (m3 === "" || /^\s+$/.test(m3)) {
                    alertify.error("Faltan los metros cubicos del producto");
                    return false;
                }
            } else {
                m3 = 0;
            }
            var info = "producto=" + nombreProducto + "&marca=" + marca + "&proveedor=" + proveedor + "&codigoProducto=" + codigoProducto + "&costoProducto=" + costoProducto + "&lista=" + lista + "&min=" + min + "&max=" + max + "&grupoProducto=" + grupoProducto + "&unidadMedida=" + unidadMedida + "&m3=" + m3;
            $.get('editarProducto.php', info, function(x) {
                $("#consultaProducto").load("consultarProducto.php", function() {
                    $("#tdProducto").dataTable();
                });
                $("#txtNombreProducto").val("");
                $("#txtCodigoProducto").val("");
                $("#txtCodigoBarras").val("");
                $('#selectMarca').selectpicker('val', 0);
                $('#selectProveedor').selectpicker('val', 0);
                $('#selectGrupo').selectpicker('val', 0);
                $('#selectMedida').selectpicker('val', 0);
                $("#txtCostoProducto").val("");
                $("#txtCantidadMinima").val("");
                $("#txtCantidadMaxima").val("");
                $(".producto").val("");
                $(".neto").val("");
                $(".producto").attr("disabled", true);
                $(".checando").attr("checked", false);
                $("#selectProducto").load("obtenerProductos.php");
                $("#txtNombreProducto").focus();
                $("#guardarDatos").slideDown();
                $("#editarDatos").slideUp();
                alertify.success("Producto editado correctamente");
                $("#txtCodigoProducto").prop('disabled', false);
                $("#txtCodigoBarras").prop('disabled', false);
                $("#chkgranel").prop('disabled', false);
                return false;
            });
        } else {
            alertify.error("La cantidad maxima debe ser mayor a la minima");
        }
    } else {
        alertify.error("Todos los campos deben tener valor");
    }
});
//===============================Formulario a granel============================
function nuevogranel() {
    var chk = $("#chkgranel").is(":checked");
    if (chk == true) {
        $("#limpiarFormProd").slideUp();
        $("#txtNombreProducto").val("");
        $("#txtCodigoBarras").val("");
        $("#txtCodigoProducto").val("");
        $("#txtCodigoProductoG").val("");
        $('#selectMarca').selectpicker('val', 0);
        $('#selectProveedor').selectpicker('val', 0);
        $('#selectGrupo').selectpicker('val', 0);
        $('#selectMedida').selectpicker('val', 0);
        $("#txtCostoProducto").val("");
        $("#txtCantidadMinima").val("");
        $("#txtCantidadMaxima").val("");
        $(".producto").val("");
        $(".neto").val("");

        $(".producto").attr("disabled", true);
        $(".checando").attr("disabled", true);
        $(".checando").attr("checked", false);
        $("#selectProducto").load("obtenerProductos.php");

        $("#frmcbarras").slideUp();
        $("#frmcantmin").slideUp();
        $("#frmcantmax").slideUp();
        $("#guardarDatos").slideUp();

        $("#frmcodnogranel").slideUp();
        $("#frmcodgranel").slideDown();
        $("#frmcontenido").slideDown();
        $("#frmcostopieza").slideDown();
        $("#divgrande").slideUp();
        $("#wellfinder").slideUp();

        $("#txtCodigoProductoG").focus();

    } else {
        $("#limpiarFormProd").slideDown();
        $("#txtNombreProducto").val("");
        $("#txtCodigoBarras").val("");
        $("#txtCodigoProductoG").val("");
        $('#selectMarca').selectpicker('val', 0);
        $('#selectProveedor').selectpicker('val', 0);
        $('#selectGrupo').selectpicker('val', 0);
        $('#selectMedida').selectpicker('val', 0);
        $("#txtCostoProducto").val("");
        $("#txtCantidadMinima").val("");
        $("#txtCantidadMaxima").val("");
        $(".producto").val("");
        $(".neto").val("");

        $(".producto").attr("disabled", true);
        $(".checando").attr("disabled", true);
        $(".checando").attr("checked", false);
        $("#selectProducto").load("obtenerProductos.php");

        $("#divgrande").slideDown();
        $("#wellfinder").slideDown();
        $("#frmcbarras").slideDown();
        $("#frmcantmin").slideDown();
        $("#frmcantmax").slideDown();
        $("#guardarDatos").slideDown();
        $("#frmcodnogranel").slideDown();
        $("#frmcodgranel").slideUp();
        $("#frmcontenido").slideUp();
        $("#frmcostopieza").slideUp();
        $("#guardarGranel").slideUp();
        $("#editarGranel").slideUp();
        $("#txtCostoProducto").removeAttr("disabled", "disabled");
        //                $("#txtCostoPieza").attr("disabled", "disabled");
        $("#txtContenido").removeAttr("disabled", "disabled");
        $("#txtCodigoProductoG").prop("disabled", false);
        $("#limpiargranel").slideUp();
    }
}
//=============================Consultar para agranel===========================
$("#txtCodigoProductoG").keypress(function(e) {
    if (e.which == 13) {
        var codeg = $("#txtCodigoProductoG").val();
        var codeg2 = $("#txtCodigoProductoG").val() + "-GR";
        if (codeg === "" || /^\s+$/.test(codeg)) {
            $("#txtCodigoProductoG").val("");
            $("#txtNombreProducto").val("");
            $("#txtCodigoBarras").val("");
            $('#selectMarca').selectpicker('val', 0);
            $('#selectProveedor').selectpicker('val', 0);
            $('#selectGrupo').selectpicker('val', 0);
            $('#selectMedida').selectpicker('val', 0);
            $("#txtCostoProducto").val("");
            $("#txtCantidadMinima").val("");
            $("#txtCantidadMaxima").val("");
            $(".producto").val("");
            $(".neto").val("");
            $(".producto").attr("disabled", true);
            $(".checando").attr("disabled", true);
            $(".checando").attr("checked", false);
            $("#selectProducto").load("obtenerProductos.php");
            $("#guardarGranel").slideUp();
            $("#editarGranel").slideUp();
            $("#txtCodigoProductoG").val("");
            $("#txtCodigoProductoG").focus("");
            $("#divgrande").slideUp();
        } else {
//Verificando el prodcuto por codigo a granel===========================
            var controlg = 1;
            var info2 = "codigoProducto=" + codeg2 + "&controlg=" + controlg;
            $.get('verificandoProducto.php', info2, function(x) {             //Si no existe el producto por codigo granel========================
                if (x < 1) {
                    var controlg = 1;
                    var info = "codigoProducto=" + codeg + "&controlg=" + controlg;
                    $.get('verificandoProducto.php', info, function(x) {                     //Si no existe el producto==================================
                        if (x < 1) {
                            $("#txtCostoProducto").addClass("disable", "dissable");
                            $("#txtNombreProducto").val("");
                            $("#txtCodigoBarras").val("");
                            $('#selectMarca').selectpicker('val', 0);
                            $('#selectProveedor').selectpicker('val', 0);
                            $('#selectGrupo').selectpicker('val', 0);
                            $('#selectMedida').selectpicker('val', 0);
                            $("#txtCostoProducto").val("");
                            $("#txtCantidadMinima").val("");
                            $("#txtCantidadMaxima").val("");
                            $(".producto").val("");
                            $(".neto").val("");
                            $(".producto").attr("disabled", true);
                            $(".checando").attr("disabled", true);
                            $(".checando").attr("checked", false);
                            $("#selectProducto").load("obtenerProductos.php");
                            $("#guardarGranel").slideUp();
                            $("#editarGranel").slideUp();
                            $("#txtCodigoProductoG").val("");
                            $("#txtCodigoProductoG").focus("");
                            $("#divgrande").slideUp();
                            alertify.error("Debe existir el producto");
                        } else {
                            //Existe el producto====================================
                            $("#txtCostoProducto").addClass("disable", "dissable");
                            $("#txtNombreProducto").val("");
                            $("#txtCodigoBarras").val("");
                            $("#txtContenido").val("");
                            $('#selectMarca').selectpicker('val', 0);
                            $('#selectProveedor').selectpicker('val', 0);
                            $('#selectGrupo').selectpicker('val', 0);
                            $('#selectMedida').selectpicker('val', 0);
                            $("#txtCostoProducto").val("");
                            $("#txtCantidadMinima").val("");
                            $("#txtCantidadMaxima").val("");
                            $(".producto").val("");
                            $(".neto").val("");
                            $(".producto").attr("disabled", true);
                            $(".checando").attr("disabled", true);
                            $(".checando").attr("checked", false);

                            lista = JSON.parse(x);
                            $.each(lista, function(ind, elem) {
                                if (ind == "cantidad") {
                                    $("#respaldaExistencia").val(elem);
                                }
                                if (ind == "producto") {
                                    $("#txtNombreProducto").val(elem);
                                }
                                if (ind == "idUnidadMedida") {
                                    $('#selectMedida').selectpicker('val', elem);
                                }
                                if (ind == "idGrupoProducto") {
                                    $('#selectGrupo').selectpicker('val', elem);
                                }
                                if (ind == "idMarca") {
                                    $('#selectMarca').selectpicker('val', elem);
                                }
                                if (ind == "idProveedor") {
                                    $('#selectProveedor').selectpicker('val', elem);
                                }
                                if (ind == "costo") {
                                    $("#txtCostoPieza").val(elem);
                                }
                                if (ind == "metrosCubicos") {
                                    $("#m3").val(elem);
                                }

                            });
                            $("#txtCodigoProductoG").prop("disabled", true);
                            var existencia = parseFloat($("#respaldaExistencia").val());
                            //Si la existencia del producto es 0====================
                            if (existencia == 0) {
                                alertify.alert("No hay existencias del producto ingresado, para su venta a granel");
                                $("#txtCostoProducto").addClass("disable", "dissable");
                                $("#txtNombreProducto").val("");
                                $("#txtCodigoBarras").val("");
                                $('#selectMarca').selectpicker('val', 0);
                                $('#selectProveedor').selectpicker('val', 0);
                                $('#selectGrupo').selectpicker('val', 0);
                                $('#selectMedida').selectpicker('val', 0);
                                $("#txtCostoProducto").val("");
                                $("#txtCantidadMinima").val("");
                                $("#txtCantidadMaxima").val("");
                                $(".producto").val("");
                                $(".neto").val("");

                                $(".producto").attr("disabled", true);
                                $(".checando").attr("disabled", true);
                                $(".checando").attr("checked", false);
                                $("#selectProducto").load("obtenerProductos.php");

                                $("#guardarGranel").slideUp();
                                $("#editarGranel").slideUp();
                                $("#txtCodigoProductoG").val("");
                                $("#txtCodigoProductoG").focus("");
                                $("#divgrande").slideUp();
                            } else {
                                //Si la existencia del producto es mayor que cero===
                                $("#divgrande").slideDown();
                                $("#txtCostoProducto").attr("disabled", "disabled");
//                            $("#txtCostoPieza").attr("disabled", "disabled");
                                $("#guardarGranel").slideDown();
                                $("#editarGranel").slideUp();
                                $("#limpiargranel").slideDown();
                            }
                        }
                    });
                } else {
                    //Si existe el producto a granel================================
                    $("#txtCostoProducto").addClass("disable", "dissable");
                    $("#txtNombreProducto").val("");
                    $("#txtCodigoBarras").val("");
                    $("#txtContenido").val("");
                    $('#selectMarca').selectpicker('val', 0);
                    $('#selectProveedor').selectpicker('val', 0);
                    $('#selectGrupo').selectpicker('val', 0);
                    $('#selectMedida').selectpicker('val', 0);
                    $("#txtCostoProducto").val("");
                    $("#txtCantidadMinima").val("");
                    $("#txtCantidadMaxima").val("");
                    $(".producto").val("");
                    $(".neto").val("");
                    lista = JSON.parse(x);
                    $.each(lista, function(ind, elem) {
                        if (ind == "cantidad") {
                            $("#respaldaExistencia").val(elem);
                        }
                        if (ind == "producto") {
                            $("#txtNombreProducto").val(elem);
                        }
                        if (ind == "idUnidadMedida") {
                            $('#selectMedida').selectpicker('val', elem);
                        }
                        if (ind == "idGrupoProducto") {
                            $('#selectGrupo').selectpicker('val', elem);
                        }
                        if (ind == "idMarca") {
                            $('#selectMarca').selectpicker('val', elem);
                        }
                        if (ind == "idProveedor") {
                            $('#selectProveedor').selectpicker('val', elem);
                        }
                        if (ind == "costo") {
                            $("#txtCostoProducto").val(elem);
                        }
                        if (ind == "metrosCubicos") {
                            $("#m3").val(elem);
                        }
                    });
                    $("#txtCodigoProductoG").prop("disabled", true);
                    var existencia = parseFloat($("#respaldaExistencia").val());
                    $.get('obtenerDatosAgranel.php', info2, function(rs) {
                        var arr = $.parseJSON(rs);
                        $("#txtContenido").val(arr.granel.datos.contenido);
                        var costo = $("#txtCostoProducto").val();
                        var costopieza = costo * arr.granel.datos.contenido;
                        alert(costopieza);
                        $("#txtCostoPieza").val(costopieza.toFixed(2));
                    });
                    $.get('obtenerTarifasPorConsulta.php', info2, function(x) {
                        lista = JSON.parse(x);
                        console.log(lista);
                        var provando = 0;
                        $(".producto").val("");
                        $(".producto").attr("disabled", true);
                        $.each(lista, function(indice, elemento) {
                            $.each(elemento, function(ind, elem) {
                                if (ind == 0) {
                                    provando = elem;
                                }
                                if (ind == "porcentaUtilidad") {
                                    provando = provando.replace(" ", "_");
                                    var costo = $("#txtCostoProducto").val();
                                    var utilidad = costo * (elem / 100);
                                    $("#util" + provando).val(utilidad);
                                    utilidad = parseFloat(utilidad) + parseFloat(costo);
                                    $("#texto" + provando).val(elem);
                                    $("#texto" + provando).attr("disabled", false);
                                    $("#check" + provando).prop("disabled", false);
                                    $("#check" + provando).prop("checked", true);
                                    $("#tarifa" + provando).val(utilidad);
                                    provando = 0;
                                }
                            });
                        });
                    });

                    $("#divgrande").slideDown();
                    $("#txtCostoProducto").attr("disabled", "disabled");
//                $("#txtCostoPieza").attr("disabled", "disabled");
                    $("#txtContenido").attr("disabled", "disabled");
                    $("#guardarGranel").slideUp();
                    $("#editarGranel").slideDown();
                    $("#limpiargranel").slideDown();
                }
            });
        }
    }
});
//=============================Calular costo granel=============================
$("#txtContenido").blur(function() {
    var costoPieza = $("#txtCostoPieza").val();
    var cantidad = $("#txtContenido").val();
    if (cantidad === "" || /^\s+$/.test(cantidad)) {
        $("#txtContenido").focus();
        return false;
    } else {
        if (costoPieza === "" || /^\s+$/.test(costoPieza)) {
            $(".producto").val("");
            $(".neto").val("");
            $(".producto").attr("disabled", true);
            $(".checando").attr("disabled", true);
            $(".checando").attr("checked", false);
        } else {
            calcostogranel();
        }
    }
});

$("#txtCostoPieza").blur(function() {
    var costoPieza = $("#txtCostoPieza").val();
    var cantidad = $("#txtContenido").val();

    if (costoPieza === "" || /^\s+$/.test(costoPieza)) {
        $("#txtCostoPieza").focus();
        return false;
    } else {
        if (cantidad === "" || /^\s+$/.test(cantidad)) {
            $(".producto").val("");
            $(".neto").val("");
            $(".producto").attr("disabled", true);
            $(".checando").attr("disabled", true);
            $(".checando").attr("checked", false);
        } else {
            calcostogranel();
        }
    }
});


function calcostogranel() {
    var costoPieza = $("#txtCostoPieza").val();
    var cantidad = $("#txtContenido").val();

    if (cantidad === "" || /^\s+$/.test(cantidad)) {
        $("#txtCostoProducto").val("");
        $("#txtContenido").val("");
    } else {
        var cantidad = parseFloat($("#txtContenido").val());
        if (cantidad == 0) {
            $("#txtContenido").val("");
            $("#txtCostoProducto").val("");
            alertify.error("El contenido del producto no puede ser igual a 0");
        } else {
            var costo = costoPieza / cantidad;
            $("#txtCostoProducto").val(costo.toFixed(2));
            obtenerUtilidadCosto();
        }
    }
}
//=============================Guardar producto agranel=========================
$("#guardarGranel").click(function() {
    var lista;
    var nombreProducto = $("#txtNombreProducto").val().toUpperCase();
    var marca = $("#selectMarca").val();
    var proveedor = $("#selectProveedor").val();
    var original = $("#txtCodigoProductoG").val();
    var codigoProducto = $("#txtCodigoProductoG").val() + "-GR";
    var costoProducto = parseFloat($("#txtCostoProducto").val());
    var min = 0;
    var max = 1;
    var unidadMedida = $("#selectMedida").val();
    var grupoProducto = $("#selectGrupo").val();
    var cbarras = 000000;
    var granel = 1;
    var contenido = $("#txtContenido").val();
    var listaPrecios = new Array();
    var listaTarifas = new Array();
    var m3 = 0;
    $("#tablaListaPrecios").find('.producto').each(function() {
        var elemento = this;
        var nombre = elemento.name;
        var valor = elemento.value;
        if (valor !== "") {
            if (valor !== " ") {
                if (valor !== null) {
                    var algo = valor + "-" + nombre;
                    listaPrecios.push(algo);
                    lista = JSON.stringify(listaPrecios);
                    valor = "";
                    nombre = "";
                } else {
                }
            } else {
            }

        } else {
        }
    });
    if (contenido !== "" && cbarras !== "" && nombreProducto !== "" && marca !== "" && proveedor !== "" && codigoProducto !== "" && costoProducto !== "" && lista !== "" && min !== "" && max !== "" && lista !== " " && lista !== null && lista !== undefined && unidadMedida !== "" && grupoProducto !== "" && marca !== "0" && proveedor !== "0" && grupoProducto !== "0" && unidadMedida !== "0" && unidadMedida !== "0") {
        if (min < max) {
            var info = "producto=" + nombreProducto + "&cbarras=" + cbarras + "&marca=" + marca + "&proveedor=" + proveedor + "&codigoProducto=" + codigoProducto + "&costoProducto=" + costoProducto + "&lista=" + lista + "&min=" + min + "&max=" + max + "&grupoProducto=" + grupoProducto + "&unidadMedida=" + unidadMedida + "&granel=" + granel + "&contenido=" + contenido + "&original=" + original + "&m3=" + m3;
            $.get('guardarProducto.php', info, function(x) {
                if (x == 1) {
                    $("#consultaProducto").load("consultarProducto.php", function() {
                        $("#tdProducto").dataTable();
                    });
                    $("#txtCodigoProductoG").val("");
                    $("#txtContenido").val("");
                    $("#txtCostoPieza").val("");
                    $("#txtNombreProducto").val("");
                    $("#txtCodigoBarras").val("");
                    $("#txtCodigoProducto").val("");
                    $('#selectMarca').selectpicker('val', 0);
                    $('#selectProveedor').selectpicker('val', 0);
                    $('#selectGrupo').selectpicker('val', 0);
                    $('#selectMedida').selectpicker('val', 0);
                    $("#txtCostoProducto").val("");
                    $("#txtCantidadMinima").val("");
                    $("#txtCantidadMaxima").val("");
                    $(".producto").val("");
                    $(".neto").val("");
                    $(".producto").attr("disabled", true);
                    $(".checando").attr("checked", false);
                    $("#selectProducto").load("obtenerProductos.php");
                    alertify.success("Producto agregado correctamente");
                    $("#chkgranel").prop('disabled', false);
                    $("#txtCodigoProductoG").prop('disabled', false);
                } else {
                    $("#consultaProducto").load("consultarProducto.php", function() {
                        $("#tdProducto").dataTable();
                    });
                    $("#txtNombreProducto").val("");
                    $("#txtCodigoBarras").val("");
                    $("#txtCodigoProducto").val("");
                    $('#selectMarca').selectpicker('val', 0);
                    $('#selectProveedor').selectpicker('val', 0);
                    $('#selectGrupo').selectpicker('val', 0);
                    $('#selectMedida').selectpicker('val', 0);
                    $("#txtCostoProducto").val("");
                    $("#txtCantidadMinima").val("");
                    $("#txtCantidadMaxima").val("");
                    $(".producto").val("");
                    $(".neto").val("");
                    $(".producto").attr("disabled", true);
                    $(".checando").attr("checked", false);
                    $("#selectProducto").load("obtenerProductos.php");
                    alertify.error("Este producto ya fue agregado");
                }
            });
        } else {
            alertify.error("La cantidad maxima debe ser mayor a la minima");
        }
    } else {
        alertify.error("Todos los campos deben tener valor");
    }
});
//==============================Editar granel===================================
$("#editarGranel").click(function() {
    var lista;
    var nombreProducto = $("#txtNombreProducto").val().toUpperCase();
    var unidadMedida = $("#selectMedida").val();
    var grupoProducto = $("#selectGrupo").val();
    var contenido = $("#txtContenido").val();
    var codigoProducto = $("#txtCodigoProductoG").val() + "-GR";
    var costoProducto = $("#txtCostoProducto").val();
    var marca = $("#selectMarca").val();
    var proveedor = $("#selectProveedor").val();
    var listaPrecios = new Array();
    $("#tablaListaPrecios").find('.producto').each(function() {
        var elemento = this;
        var nombre = elemento.name;
        var valor = elemento.value;
        var algo = valor + "-" + nombre;
        listaPrecios.push(algo);
        lista = JSON.stringify(listaPrecios);
        valor = "";
        nombre = "";
    });
    if (nombreProducto !== "" && marca !== "" && proveedor !== "" && contenido !== "" && codigoProducto !== "" && costoProducto !== "" && lista !== "" && lista !== " " && lista !== null && lista !== undefined && unidadMedida !== "" && grupoProducto !== "") {
        var info = "producto=" + nombreProducto + "&marca=" + marca + "&proveedor=" + proveedor + "&codigoProducto=" + codigoProducto + "&costoProducto=" + costoProducto + "&lista=" + lista + "&grupoProducto=" + grupoProducto + "&unidadMedida=" + unidadMedida + "&contenido=" + contenido;
        $.get('editarProductoGranel.php', info, function(x) {
            $("#consultaProducto").load("consultarProducto.php", function() {
                $("#tdProducto").dataTable();
            });
            $("#txtCodigoProductoG").val("");
            $("#txtNombreProducto").val("");
            $("#txtCodigoBarras").val("");
            $('#selectMarca').selectpicker('val', 0);
            $('#selectProveedor').selectpicker('val', 0);
            $('#selectGrupo').selectpicker('val', 0);
            $('#selectMedida').selectpicker('val', 0);
            $("#txtCostoProducto").val("");
            $("#txtCantidadMinima").val("");
            $("#txtCantidadMaxima").val("");
            $(".producto").val("");
            $(".neto").val("");
            $(".producto").attr("disabled", true);
            $(".checando").attr("disabled", true);
            $(".checando").attr("checked", false);
            $("#selectProducto").load("obtenerProductos.php");

            $("#guardarGranel").slideUp();
            $("#editarGranel").slideUp();
            $("#txtCodigoProductoG").val("");
            $("#txtCodigoProductoG").focus("");
            $("#divgrande").slideUp();
            alertify.success("Producto agregado correctamente");
            $("#txtCodigoProductoG").prop("disabled", false);
            return false;
        });
    } else {
        alertify.error("Todos los campos deben tener valor");
    }
});
//==============================================================================
$("#selectGrupo").change(function() {
    var seleccion = document.getElementById('selectGrupo');
    var dato = $("#selectGrupo").val();
    var dato2 = seleccion.options[seleccion.selectedIndex].text;

    if (dato == 1 || dato2 == 'MADERAS') {
        $("#divm3").slideDown();
    } else {
        $("#divm3").slideUp();
    }
});
//==============================================================================
$("#limpiargranel").click(function() {
    $("#txtNombreProducto").val("");
    $("#txtCodigoBarras").val("");
    $("#txtCodigoProducto").val("");
    $("#txtCodigoProductoG").val("");
    $('#selectMarca').selectpicker('val', 0);
    $('#selectProveedor').selectpicker('val', 0);
    $('#selectGrupo').selectpicker('val', 0);
    $('#selectMedida').selectpicker('val', 0);
    $("#txtCostoProducto").val("");
    $("#txtCantidadMinima").val("");
    $("#txtCantidadMaxima").val("");
    $(".producto").val("");
    $(".neto").val("");

    $(".producto").attr("disabled", true);
    $(".checando").attr("disabled", true);
    $(".checando").attr("checked", false);
    $("#selectProducto").load("obtenerProductos.php");


    $("#divgrande").slideUp();

    $("#txtCodigoProductoG").focus();
    $("#limpiargranel").slideUp();
    $("#editarGranel").slideUp();
    $("#guardarGranel").slideUp();
    $("#txtCodigoProductoG").prop('disabled', false);
});
