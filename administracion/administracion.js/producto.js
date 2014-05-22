function NumCheck(e, field) {
    key = e.keyCode ? e.keyCode : e.which;
    if (key == 15)
        ;
    return true;
    if (key > 47 && key < 58) {
        if (field.value == "")
            ;
        return true;
        regexp = /.[0-9]{20}$/;
        return !(regexp.test(field.value));
    }
    if (key == 46) {
        if (field.value == "")
            ;
        return false;
        regexp = /^[0-9]+$/;
        return regexp.test(field.value);
    }
    return false;
}

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
        uti = uti / 100;
        if (uti <= 0) {
            var resultado = costo;
            $("#tarifa" + valor).val(resultado.toFixed(2));
        } else {
            var resultado = costo * uti;
            $("#util" + valor).val(resultado.toFixed(2));
            resultado = parseFloat(resultado) + parseFloat(costo);

            $("#tarifa" + valor).val(resultado.toFixed(2));
        }
    });
}

$(document).ready(function() {
    $("#guardarGranel").hide();
    $("#editarGranel").hide();
    $("#frmcodgranel").hide();
    $("#frmcontenido").hide();
    $("#frmcostopieza").hide();
    $("#editarDatos").hide();
    $("#divm3").hide();
    $('#txtCodigoProducto').validCampoFranz(' abcdefghijklmnñopqrstuvwxyzáéiou1234567890."%()');
    $('#txtNombreProducto').validCampoFranz(' abcdefghijklmnñopqrstuvwxyzáéiou1234567890."%()');
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

$("#finder").blur(function() {
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
                $(".checando").attr("disabled", true);
                $(".checando").attr("checked", false);
                $("#selectProducto").load("obtenerProductos.php");
                $("#guardarDatos").show();
                $("#editarDatos").hide();
                $("#finder").val("");
            } else {
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
                                $("#check" + provando).prop({
                                    disabled: false,
                                    Checked: true
                                });
                                $("#tarifa" + provando).val(utilidad);
                                provando = 0;
                            }
                        });
                    });
                });
                $("#finder").val("");
                $("#guardarDatos").hide();
                $("#editarDatos").show();
            }
        });
    }
});

//    $("#txtCodigoBarras").blur(function() {
//        var codigoProducto = $("#txtCodigoBarras").val();
//        var info = "codigoProducto=" + codigoProducto;
//        $.get('verificandoProducto.php', info, function(x) {
//            if (x < 1) {
//                var codpro = $("#txtCodigoProducto").val();
//                if (codpro === "" || /^\s+$/.test(codpro)) {
//                    $("#txtCodigoProducto").val("");
//                }
//                $("#txtNombreProducto").val("");
//                $('#selectMarca').selectpicker('val', 0);
//                $('#selectProveedor').selectpicker('val', 0);
//                $('#selectGrupo').selectpicker('val', 0);
//                $('#selectMedida').selectpicker('val', 0);
//                $("#txtCostoProducto").val("");
//                $("#txtCantidadMinima").val("");
//                $("#txtCantidadMaxima").val("");
//                $(".producto").val("");
//                $(".neto").val("");
//
//                $(".producto").attr("disabled", true);
//                $(".checando").attr("disabled", true);
//                $(".checando").attr("checked", false);
//                $("#selectProducto").load("obtenerProductos.php");
//                $("#guardarDatos").show();
//                $("#editarDatos").hide();
//            } else {
//                lista = JSON.parse(x);
//                console.log(lista);
//                $(".producto").attr("disabled", true);
//                $(".checando").attr({
//                    checked: false,
//                    disabled: false
//                });
//                $.each(lista, function(ind, elem) {
//                    if (ind == "codigoProducto") {
//                        $("#txtCodigoProducto").val(elem);
//                    }
//                    if (ind == "producto") {
//                        $("#txtNombreProducto").val(elem);
//                    }
//                    if (ind == "idUnidadMedida") {
//                        $('#selectMedida').selectpicker('val', elem);
//                    }
//                    if (ind == "idGrupoProducto") {
//                        $('#selectGrupo').selectpicker('val', elem);
//                    }
//                    if (ind == "idMarca") {
//                        $('#selectMarca').selectpicker('val', elem);
//                    }
//                    if (ind == "idProveedor") {
//                        $('#selectProveedor').selectpicker('val', elem);
//                    }
//                    if (ind == "costo") {
//                        $("#txtCostoProducto").val(elem);
//                    }
//                    if (ind == "cantidadMaxima") {
//                        $("#txtCantidadMaxima").val(elem);
//                    }
//                    if (ind == "cantidadMinima") {
//                        $("#txtCantidadMinima").val(elem);
//                    }
//                    var info = "codigoProducto=" + codigoProducto;
//
//                });
//                $.get('obtenerTarifasPorConsulta.php', info, function(x) {
//
//                    lista = JSON.parse(x);
//                    console.log(lista);
//                    var provando = 0;
//                    $(".producto").val("");
//                    $(".producto").attr("disabled", true);
//                    $.each(lista, function(indice, elemento) {
//                        $.each(elemento, function(ind, elem) {
//                            if (ind == 0) {
//
//
//                                provando = elem;
//
//                            }
//                            if (ind == "porcentaUtilidad") {
//
//                                provando = provando.replace(" ", "_")
//
//                                var costo = $("#txtCostoProducto").val();
//                                var utilidad = costo * (elem / 100);
//                                $("#util" + provando).val(utilidad);
//                                utilidad = parseFloat(utilidad) + parseFloat(costo);
//
//                                $("#texto" + provando).val(elem);
//                                $("#texto" + provando).attr("disabled", false);
//
//                                $("#check" + provando).prop({
//                                    disabled: false,
//                                    Checked: true
//                                });
//                                $("#tarifa" + provando).val(utilidad);
//                                provando = 0;
//                            }
//
//                        });
//                    });
//                });
//                $("#guardarDatos").hide();
//                $("#editarDatos").show();
//            }
//        });
//    });

//    $("#txtCodigoProducto").blur(function() {
//        var codigoProducto = $("#txtCodigoProducto").val();
//        var info = "codigoProducto=" + codigoProducto;
//        $.get('verificandoProducto.php', info, function(x) {
//            if (x < 1) {
//                var codprob = $("#txtCodigoBarras").val();
//                if (codprob === "" || /^\s+$/.test(codprob)) {
//                    $("#txtCodigoBarras").val("");
//                }
//                $("#txtNombreProducto").val("");
//                $('#selectMarca').selectpicker('val', 0);
//                $('#selectProveedor').selectpicker('val', 0);
//                $('#selectGrupo').selectpicker('val', 0);
//                $('#selectMedida').selectpicker('val', 0);
//                $("#txtCostoProducto").val("");
//                $("#txtCantidadMinima").val("");
//                $("#txtCantidadMaxima").val("");
//                $(".producto").val("");
//                $(".neto").val("");
//
//                $(".producto").attr("disabled", true);
//                $(".checando").attr("disabled", true);
//                $(".checando").attr("checked", false);
//                $("#selectProducto").load("obtenerProductos.php");
//                $("#guardarDatos").show();
//                $("#editarDatos").hide();
//            } else {
//                lista = JSON.parse(x);
//                console.log(lista);
//                $(".producto").attr("disabled", true);
//                $(".checando").attr({
//                    checked: false,
//                    disabled: false
//                });
//                $.each(lista, function(ind, elem) {
//                    if (ind == "codigoBarrasProducto") {
//                        $("#txtCodigoBarras").val(elem);
//                    }
//                    if (ind == "producto") {
//                        $("#txtNombreProducto").val(elem);
//                    }
//                    if (ind == "idUnidadMedida") {
//                        $('#selectMedida').selectpicker('val', elem);
//                    }
//                    if (ind == "idGrupoProducto") {
//                        $('#selectGrupo').selectpicker('val', elem);
//                    }
//                    if (ind == "idMarca") {
//                        $('#selectMarca').selectpicker('val', elem);
//                    }
//                    if (ind == "idProveedor") {
//                        $('#selectProveedor').selectpicker('val', elem);
//                    }
//                    if (ind == "costo") {
//                        $("#txtCostoProducto").val(elem);
//                    }
//                    if (ind == "cantidadMaxima") {
//                        $("#txtCantidadMaxima").val(elem);
//                    }
//                    if (ind == "cantidadMinima") {
//                        $("#txtCantidadMinima").val(elem);
//                    }
//                    var info = "codigoProducto=" + codigoProducto;
//
//                });
//                $.get('obtenerTarifasPorConsulta.php', info, function(x) {
//                    lista = JSON.parse(x);
//                    console.log(lista);
//                    var provando = 0;
//                    $(".producto").val("");
//                    $(".producto").attr("disabled", true);
//                    $.each(lista, function(indice, elemento) {
//                        $.each(elemento, function(ind, elem) {
//                            if (ind == 0) {
//                                provando = elem;
//                            }
//                            if (ind == "porcentaUtilidad") {
//                                provando = provando.replace(" ", "_")
//                                var costo = $("#txtCostoProducto").val();
//                                var utilidad = costo * (elem / 100);
//                                $("#util" + provando).val(utilidad);
//                                utilidad = parseFloat(utilidad) + parseFloat(costo);
//                                $("#texto" + provando).val(elem);
//                                $("#texto" + provando).attr("disabled", false);
//                                $("#check" + provando).prop({
//                                    disabled: false,
//                                    Checked: true
//                                });
//                                $("#tarifa" + provando).val(utilidad);
//                                provando = 0;
//                            }
//                        });
//                    });
//                });
//                $("#guardarDatos").hide();
//                $("#editarDatos").show();
//            }
//        });
//    });

$("#guardarDatos").click(function() {
    var lista;
    var nombreProducto = $("#txtNombreProducto").val().toUpperCase();
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
                    alertify.error("Faltan los metros cubicos del prodcuto");
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
                    alertify.success("Producto agregada correctamente");
                    return false;
                } else {
                    alertify.error("El codigo ya existe");
                }
            });
        } else {
            alertify.error("La cantidad maxima debe ser mayor a la minima");
        }
    } else {
        alertify.error("Todos los campos deben tener valor");
    }
});

$('#editarDatos').click(function() {
    var lista;
    var nombreProducto = $("#txtNombreProducto").val().toUpperCase();
    var marca = $("#selectMarca").val();
    var proveedor = $("#selectProveedor").val();
    var codigoProducto = $("#txtCodigoProducto").val();
    var costoProducto = parseFloat($("#txtCostoProducto").val());
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

    if (nombreProducto !== "" && marca !== "" && proveedor !== "" && codigoProducto !== "" && costoProducto !== "" && lista !== "" && min !== "" && max !== "" && lista !== " " && lista !== null && lista !== undefined && unidadMedida !== "" && grupoProducto !== "") {
        if (min < max) {
            if (grupoProducto == 1 || dato2 == 'MADERAS') {
                var m3 = $("#m3").val();
                if (m3 === "" || /^\s+$/.test(m3)) {
                    alertify.error("Faltan los metros cubicos del prodcuto");
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
                return false;
            });
        } else {
            alertify.error("la cantidad maxima debe ser mayor a la minima");
        }
    } else {
        alertify.error("todos los campos deben tener valor");
    }
});
//    $("#selectTarifa").change(function() {
//
//        var Tarifa = $("#selectTarifa").val();
//        alert(Tarifa);
//        $("#tablaTarifas").load("consultarProductoTarifa.php?tarifa=" + Tarifa);
//    });
//    $("#btnTarifa").click(function() {
//        var Tarifa = $("#txtTarifa").val();
//        var selectTarifa = $("#selectTarifa").val();
//        var info = "Tarifa=" + Tarifa + "&listaPrecio=" + selectTarifa;
//        $.get('guardarTarifa.php', info, function() {
//
////            $('#formulario').hide('slow');
////            $("#selectTarifa").load("mostrarListaPrecios.php");
////            $('#checarListas').show('hide');
//            alertify.success("Tarifa del Producto agregado correctamente");
//            return false;
//        });
//    });
//    $("#selectProducto").load("obtenerProductos.php");
//    $("#selectProducto").change(function() {
//        var producto = $("#selectProducto").val();
//        info = "producto=" + producto;
//        $.get('obtenerExistencia.php', info, function(existencia) {
//            existenciaInventario = existencia;
//            $("#existencia").html('<h4> hay en existencia= ' + existenciaInventario + '</h4>');
//        });
//    });
//    $("#AgregarEntrada").click(function() {
//        var cantidad = $("#txtEntradaProducto").val();
//        var idProducto = $("#selectProducto").val();
//        var info = "cantidad=" + cantidad + "&idProducto=" + idProducto + "&existenciaActual=" + existenciaInventario;
//        $.get('guardarEntrada.php', info, function(comprobar) {
//            alert(comprobar);
//            if (comprobar == "OK") {
//
//                $("#selectProducto").val(0);
//                $("#txtEntradaProducto").val("");
//                $("#existencia").html('<h4> hay en existencia=0</h4>');
//                alertify.success("se guardo la Cantidad exitosamente");
//            } else {
//                alertify.error("no Se ha Guardado");
//            }
//        });
//    });

//    $('#consultaProducto tr>*').click(function (e) {
//        var a = $(this).closest('tr').find('a')
//        e.preventDefault()
//        location.href = a.attr('href')
//    })



//    $(document).on('change', '#selectListaPrecios', function() {
//        //almacenamos en una variable todo el contenido de la nueva fila que deseamos
//        //agregar. pueden incluirse id's, nombres y cualquier tag... sigue siendo html   onclick="eliminar(\'' + valor + '\');"
//        var valor = $("#selectListaPrecios").val();
//
//        var palabras = valor.split("-");
//        
//        var strNueva_Fila = '<tr>' +
//                '<td>' + palabras[1] + '</td>' +
//                '<td><input type="text" class="clsAnchoTotal" id="palabras"></td>' +
//                '<td align="right"><button type="submit" class="clsEliminarFila" id="botonazo" value="' + valor + '"/>-</button></td>' +
//                "</tr>";
//
//        $("#selectListaPrecios").find("option[value=" + valor + "]").remove();
//        /*obtenemos el padre del boton presionado (en este caso queremos la tabla, por eso
//         utilizamos get(3)
//         table -> padre 3
//         tfoot -> padre 2
//         tr -> padre 1
//         td -> padre 0
//         nosotros queremos utilizar el padre 3 para agregarle en la etiqueta
//         tbody una nueva fila*/
//        var objTabla = $(this).parents().get(3);
//
//        //agregamos la nueva fila a la tabla
//        $(objTabla).find('tbody').append(strNueva_Fila);
//
//        //si el cuerpo la tabla esta oculto (al agregar una nueva fila) lo mostramos
//        if (!$(objTabla).find('tbody').is(':visible')) {
//            //le hacemos clic al titulo de la tabla, para mostrar el contenido
//            $(objTabla).find('caption').click();
//        }
//    });
////
//    $(document).on('click', '.clsEliminarFila', function() {
//        /*obtener el cuerpo de la tabla; contamos cuantas filas (tr) tiene
//         si queda solamente una fila le preguntamos al usuario si desea eliminarla*/
//        var valor = $("#botonazo").val();
//        alert(valor);
//        var objCuerpo = $(this).parents().get(2);
//        if ($(objCuerpo).find('tr').length == 1) {
//            if (!confirm('Esta es el única fila de la lista ¿Desea eliminarla?')) {
//                return;
//            }
//        }
//        /*obtenemos el padre (tr) del td que contiene a nuestro boton de eliminar
//         que quede claro: estamos obteniendo dos padres
//         el asunto de los padres e hijos funciona exactamente como en la vida real
//         es una jergarquia. imagine un arbol genealogico y tendra todo claro ;)
//         tr	--> padre del td que contiene el boton
//         td	--> hijo de tr y padre del boton
//         boton --> hijo directo de td (y nieto de tr? si!)
//         */
//        var objFila = $(this).parents().get(1);
//        /*eliminamos el tr que contiene los datos del contacto (se elimina todo el
//         contenido (en este caso los td, los text y logicamente, el boton */
//        $(objFila).remove();
//
//        $('#selectListaPrecios').append('<option value=' + valor + '>' + valor + '</option>');
//
//    });




//===============================Formulario a granel============================

function nuevogranel() {
    var chk = $("#chkgranel").is(":checked");
    if (chk == true) {
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
    }
}
//=============================Consultar para agranel===========================
$("#txtCodigoProductoG").blur(function() {
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
        $.get('verificandoProducto.php', info2, function(x) {
            //Si no existe el producto por codigo granel========================
            if (x < 1) {
                var controlg = 1;
                var info = "codigoProducto=" + codeg + "&controlg=" + controlg;
                $.get('verificandoProducto.php', info, function(x) {
                    //Si no existe el producto==================================
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
                        alertify.error("Deber existir el producto");
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
                        });
                        var existencia = parseFloat($("#respaldaExistencia").val());
                        alert("Es un producto NO granel con existencia de: " + existencia);
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
                            $("#txtCostoPieza").attr("disabled", "disabled");
                            $("#guardarGranel").slideDown();
                            $("#editarGranel").slideUp();
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
                });

                var existencia = parseFloat($("#respaldaExistencia").val());
                alert("Existencia del producto a granel: " + existencia);
                $.get('obtenerDatosAgranel.php', info2, function(rs) {
                    $("#txtContenido").val(rs);
                    var costo = $("#txtCostoProducto").val();
                    var costopieza = costo * rs;
                    $("#txtCostoPieza").val(costopieza);
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
                                $("#check" + provando).prop({
                                    disabled: false,
                                    Checked: true
                                });
                                $("#tarifa" + provando).val(utilidad);
                                provando = 0;
                            }
                        });
                    });
                });

                $("#divgrande").slideDown();
                $("#txtCostoProducto").attr("disabled", "disabled");
                $("#txtCostoPieza").attr("disabled", "disabled");
                $("#guardarGranel").slideUp();
                $("#editarGranel").slideDown();
            }
        });
    }
});
//=============================Calular costo granel=============================
$("#txtContenido").blur(function() {
    calcostogranel();
});

function calcostogranel() {
    var costoPieza = parseFloat($("#txtCostoPieza").val());
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
            var info = "producto=" + nombreProducto + "&cbarras=" + cbarras + "&marca=" + marca + "&proveedor=" + proveedor + "&codigoProducto=" + codigoProducto + "&costoProducto=" + costoProducto + "&lista=" + lista + "&min=" + min + "&max=" + max + "&grupoProducto=" + grupoProducto + "&unidadMedida=" + unidadMedida + "&granel=" + granel + "&contenido=" + contenido + "&original=" + original;
            $.get('guardarProducto.php', info, function(x) {
                if (x >= 1) {
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
                    alertify.success("Producto agregada correctamente");
                    return false;
                } else {
                    alertify.error("El codigo ya existe");
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
            alertify.success("Producto agregada correctamente");
            return false;
        });
    } else {
        alertify.error("todos los campos deben tener valor");
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