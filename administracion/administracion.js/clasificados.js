var archivos;
var grupo = "";
var arrelo;
var imagenes = new Array();
var calculando = 6;

$(document).ready(function() {
    $("#botonninja").hide();
    $("#editarImagenes").hide();
    $("#mostrarImagenes").hide();
    $("#mostrando").hide();
    $("#enslider").load("mostrarImgSlider.php", function() {
    });
    $("#consultarProductosPublicados").load("consultarClasificados.php", function() {
        $('#dtclasificados').dataTable();
    });
});

function gestionimagenes(cp, nombre) {
    $(".contenedorImagenes").empty();
    $('#botonninja').trigger('click');
    $('#labelTitulo').html('<h4> Imagenes subidas del producto:</h4>' + nombre);
    codigo = "cp=" + cp;
    $.get("mostrarImagenes.php", codigo, function(x) {
        var comprobante;
        var tipo;
        var descripcion;
        var imagenes;
        var idImagen;
        var novedades;
        var recomendado;
        var nombreGrupos;
        var producto;
        var conta = 1;
        lista = JSON.parse(x);
        console.log(lista);
        $.each(lista, function(ind, elem) {
            $.each(elem, function(ind, elem2) {
                imagenes = elem[ind].ruta;
                idImagen = elem[ind].idImagen;
                if (imagenes !== undefined) {
                    var imagen = "<img src='../subidas/" + imagenes + "' style ='width: 171px; height: 150px;'/><div class='caption'><center><button type='button' class='btn  btn-default btn-block' onclick=eliminandoImagenesconsula('" + imagenes + "','" + idImagen + "')><span class='glyphicon glyphicon-remove'></span></button></center></div>";
                    $("#imagens" + conta).append(imagen);
                    $("#contenedors" + conta).show('slow');
                    conta++;
                    $("#mostrarImagenes").show("slow");
                }
            });
        });
    });
}

function limpiarCampos() {
    $("#mostrando").hide('slow');
    $("#descripcion").val("");
    $("#selectTipo").selectpicker("val", 0);
    $("#clascodigoproducto").val("");
    $(".contenedorImagenes").empty();
    $("#conte").hide();
    $("#files").val("");
    $("#recomendado").prop("checked", false);
    $("#Novedades").prop("checked", false);
    $("#list").val("");
    $("#clascodigoproducto").prop("disabled", false);
    $("#editarDatos").hide();
    $("#guardarDatos").show();
    archivos;
    grupo = "";
    arrelo;
    imagenes = new Array();
    calculando = 6;
}

function eliminandoImagenesconsula(imagen, idImagen) {
    var arreglo = new Array();
    alertify.confirm("¿Estas completamente seguro de querer eliminar esta imagen?, Al aceptar no habra forma de recuperar los datos eliminados", function(e) {
        if (e) {
            info = "idImagen=" + idImagen + "&imagen=" + imagen;
            $.get("eliminarClasificados.php", info, function() {
                alertify.success("se elimino la imagen" + imagen + "correctamente");
            });
        } else {
        }
    });
}

function eliminandoImagenes(imagen, idImagen, cont) {
    var arreglo = new Array();
    alertify.confirm("¿Estas completamente seguro de querer eliminar esta imagen?, Al guardar cambios ya no se podra recuperar", function(e) {
        if (e) {
            arreglo = {imagen: imagen, idImagen: idImagen};
            imagenes.push(arreglo);
            console.log(imagenes);
            $("#contenedor" + cont).hide("slow");
            calculando = calculando + 1;
            $("#textoValor").text("Puedes subir maximo " + calculando + " imagenes");
        } else {
        }
    });
}

function handleFileSelect(evt) {
    var files = evt.target.files; // FileList object
    archivos = files;
    // files is a FileList of File objects. List some properties.
    var output = [];
    if (archivos.length <= calculando) {
        for (var i = 0, f; f = files[i]; i++) {
            var fileName = f.name;
            var fileExtension = fileName.substring(fileName.lastIndexOf('.') + 1);
            if (fileExtension !== "jpg" && fileExtension !== "png" && fileExtension !== "gif" && fileExtension !== "jpeg") {
                alertify.error("Solo puedes subir archivos jpg, jpeg, gif y png");
                $("#files").val("");
                $("#list").val("");
            } else {
                output.push('<li><strong>', escape(f.name), '</strong> (', fileExtension || 'n/a', ') - ',
                        f.size, ' bytes, last modified: ',
                        f.lastModifiedDate.toLocaleDateString(), '</li>');
            }
        }
        document.getElementById('list').innerHTML = '<ul>' + output.join('') + '</ul>';
    } else {
        alertify.error("Solo puedes Subir " + calculando + " imagenes");
        $("#files").val("");
        $("#list").val("");
    }

}

$("#limpiar").click(function() {
    limpiarCampos();
});

document.getElementById('files').addEventListener('change', handleFileSelect, false);

$("#clascodigoproducto").keypress(function(e) {
    if (e.which == 13) {
        damedatosclasificados();
    }
});


function damedatosclasificados() {
    var info = "codigoProducto=" + $("#clascodigoproducto").val();
    $.get("verificarExistenciaProducto.php", info, function(x) {
        var comprobante;
        var tipo;
        var descripcion;
        var imagenes;
        var idImagen;
        var novedades;
        var recomendado;
        var nombreGrupos;
        var producto;
        var cont = 1;
        lista = JSON.parse(x);
        console.log(lista);
        $.each(lista, function(ind, elem) {
            $.each(elem, function(ind, elem2) {
                grupo = elem[ind].idGrupoProducto;
                comprobante = elem[ind].comprobante;
                tipo = elem[ind].idTipo;
                descripcion = elem[ind].descripcion;
                imagenes = elem[ind].ruta;
                idImagen = elem[ind].idImagen;
                novedades = elem[ind].ponerNovedades;
                recomendado = elem[ind].ponerRecomendado;
                producto = elem[ind].nombre;
                nombreGrupos = elem[ind].grupo;
                if (imagenes !== undefined) {
                    var imagen = "<img src='../subidas/" + imagenes + "' style ='width: 100px; height: 88px;'/><div class='caption'><center><button type='button' class='btn btn-default btn-block' onclick=eliminandoImagenes('" + imagenes + "','" + idImagen + "','" + cont + "')><span class='glyphicon glyphicon-remove'></span></button></center></div>";
                    $("#imagen" + cont).append(imagen);
                    $("#contenedor" + cont).show('slow');
                    cont++;
                    $("#mostrarImagenes").show("slow");
                }
                calculando = 6 - cont;
                $("#textoValor").text("Maximo " + calculando + " imagenes");
            });
        });
        if (grupo !== "" && grupo !== undefined) {
            $("#mostrando").show();
            $("#clascodigoproducto").prop("disabled", true);
            $("#selectTipo").load("mostrarTiposProducto.php?idGrupo=" + grupo, function() {
                $("#selectTipo").selectpicker();
                $("#selectTipo").selectpicker('refresh');
                $("#selectTipo").selectpicker('show');
                if (comprobante == "1") {
                    $("#grupo").val(nombreGrupos);
                    $("#producto").val(producto);
                    $("#descripcion").val(descripcion);
                    $("#selectTipo").selectpicker("val", tipo);
                    $("#editarImagenes").show('slow');
                    $("#subirImagenes").hide('slow');
                    if (recomendado == '1') {
                        $("#recomendado").prop("checked", true);
                    }
                    if (novedades == '1') {
                        $("#Novedades").prop("checked", true);
                    }
                }
                else {
                }
            });
        } else {
            alertify.error("No existe este producto");
        }
    });
}

$("#btnGuardarTipo").click(function() {
    info = "nombreTipo=" + $.trim($("#txtnombreTipo").val().toUpperCase()) + "&idGrupo=" + grupo;
    $.get("guardarTipo.php", info, function(x) {
        if (x == 999) {
            alertify.error("Ya existe un tipo con ese nombre");
        } else {
            $("#selectTipo").load("mostrarTiposProducto.php?idGrupo=" + grupo, function() {
                $("#selectTipo").selectpicker();
                $("#selectTipo").selectpicker('refresh');
                $("#selectTipo").selectpicker('show');
            });
            alertify.success("Tipo guardado");
        }
    });
});

$("#subirImagenes").click(function() {
    if ($("#descripcion").val() !== "" && $("#clascodigoproducto").val() !== "" && $("#selectTipo").val() !== "" && $("#files").val() !== "") {
//       alert(archivos);
        var data = new FormData();
//        alert(archivos.length);
        for (i = 0; i < archivos.length; i++) {
            data.append('archivo' + i, archivos[i]);
//                alert(archivos[i]);
        }
        var nov = $("#Novedades").is(":checked");
        var reco = $("#recomendado").is(":checked");
//            alert("nov="+ nov);
//                alert("reco="+ reco);
        if (reco === true) {
            recomendados = 1;
        } else {
            recomendados = 1;
        }
        if (nov === true) {
            novedades = 1;
        } else {
            novedades = 0;
        }
        var valida_tipo = $("#selectTipo").val();
        if (valida_tipo == 0) {
            alertify.error("No seleccionaste un tipo para el clasificado");
            return false;
        }
        data.append('descripcion', probando = $("#descripcion").val());
        data.append('codigoProducto', probando = $("#clascodigoproducto").val().toUpperCase());
//        data.append('grupo', probando = $("#selectGrupo").val());
        data.append('tipo', probando = $("#selectTipo").val());
        data.append('novedades', novedades);
        data.append('recomendado', recomendados);
        data.append('faltantes', calculando);
//            alert(data);
        $.ajax({
            url: 'guardandoImagenes.php', //Url a donde la enviaremos
            type: 'POST', //Metodo que usaremos
            contentType: false, //Debe estar en false para que pase el objeto sin procesar
            data: data, //Le pasamos el objeto que creamos con los archivos
            processData: false, //Debe estar en false para que JQuery no procese los datos a enviar
            cache: false //Para que el formulario no guarde cache
        }).done(function(msg) {
//                $("#xmlenrada").slideUp();
//                $("#validacionentradas").slideDown();
//                $("#cargaxml").slideDown();
            alertify.success("Se guardaron lo datos correctamente");
            limpiarCampos();
        });
    } else {
        alertify.error("Debes llenar los campos obligatorios");
    }
});

$("#editarImagenes").click(function() {
    if ($("#descripcion").val() !== "" && $("#clascodigoproducto").val() !== "" && $("#selectTipo").val() !== "") {
        if (calculando < 5 || $("#files").val() !== "") {
            var data = new FormData();
            var listaImagenes = "";
            if (archivos !== undefined) {
                for (i = 0; i < archivos.length; i++) {
                    data.append('archivo' + i, archivos[i]);
                }
            }
            var nov = $("#Novedades").is(":checked");
            var reco = $("#recomendado").is(":checked");
            if (reco === true) {
                recomendados = 1;
            } else {
                recomendados = 0;
            }
            if (nov === true) {
                novedades = 1;
            } else {
                novedades = 0;
            }
            listaImagenes = JSON.stringify(imagenes);
            data.append('descripcion', probando = $("#descripcion").val());
            data.append('codigoProducto', probando = $("#clascodigoproducto").val().toUpperCase());
//        data.append('grupo', probando = $("#selectGrupo").val());
            data.append('tipo', probando = $("#selectTipo").val());
            data.append('novedades', novedades);
            data.append('recomendado', recomendados);
            data.append('imagenesBorradas', listaImagenes);
            $.ajax({
                url: 'editandoImagenes.php', //Url a donde la enviaremos
                type: 'POST', //Metodo que usaremos
                contentType: false, //Debe estar en false para que pase el objeto sin procesar
                data: data, //Le pasamos el objeto que creamos con los archivos
                processData: false, //Debe estar en false para que JQuery no procese los datos a enviar
                cache: false //Para que el formulario no guarde cache
            }).done(function(msg) {
//                $("#xmlenrada").slideUp();
//                $("#validacionentradas").slideDown();
//                $("#cargaxml").slideDown();
                alertify.success("Se editaron lo datos correctamente");
                limpiarCampos();
                $("#mostrarImagenes").css("display","none");
                $("#editarImagenes").hide('slow');
                $("#subirImagenes").show('slow');
            });
        } else {
            alertify.error("Debes Haber almenos una imagen para mostrar");
        }
    } else {
        alertify.error("Debes llenar los campos obligatorios");
    }
});

//=========================== Subir imagenes al slider =========================
function comprueba_extension_imgslider(formulario, archivo) {
    extensiones_permitidas = new Array(".gif", ".jpg", ".jpeg", ".png");
    mierror = "";
    if (!archivo) {
        //Si no tengo archivo, es que no se ha seleccionado un archivo en el formulario
        //mierror = "No has seleccionado ningún archivo";
        alertify.error("No has seleccionado ningún archivo");
    } else {
        //recupero la extensión de este nombre de archivo
        extension = (archivo.substring(archivo.lastIndexOf("."))).toLowerCase();
        //alert (extension);
        //compruebo si la extensión está entre las permitidas
        permitida = false;
        for (var i = 0; i < extensiones_permitidas.length; i++) {
            if (extensiones_permitidas[i] == extension) {
                permitida = true;
                break;
            }
        }
        if (!permitida) {
            //mierror = "Comprueba la extensión de los archivos a subir. \nSólo se pueden subir archivos con extensiones: " + extensiones_permitidas.join();
            alertify.error("Comprueba la extensión de los archivos a subir. \nSólo se pueden subir archivos con extensiones: " + extensiones_permitidas.join());
        } else {
            var archivos = document.getElementById("imgslider");//Damos el valor del input tipo file
            var archivo = archivos.files; //Obtenemos el valor del input (los arcchivos) en modo de arreglo
            //var texto = document.getElementById("texto").value;
            //El objeto FormData nos permite crear un formulario pasandole clave/valor para poder enviarlo 
            var data = new FormData();
            //Como no sabemos cuantos archivos subira el usuario, iteramos la variable y al 
            //objeto de FormData con el metodo "append" le pasamos calve/valor, usamos el indice "i" para
            //que no se repita, si no lo usamos solo tendra el valor de la ultima iteracion
            for (i = 0; i < archivo.length; i++) {
                data.append('archivo' + i, archivo[i]);
            }
            $.ajax({
                url: 'cargarImagenSlider.php', //Url a donde la enviaremos
                type: 'POST', //Metodo que usaremos
                contentType: false, //Debe estar en false para que pase el objeto sin procesar
                data: data, //Le pasamos el objeto que creamos con los archivos
                processData: false, //Debe estar en false para que JQuery no procese los datos a enviar
                cache: false //Para que el formulario no guarde cache
            }).done(function(msg) {
                $("#imgslider").val("");
                if (msg == 666) {
                    alertify.error("Se ha alcanzado el limite de imagenes permitidas");
                }
                if (msg == 0) {
                    alertify.success("Imagen cargada correctamente");
                }
                if (msg == 1) {
                    alertify.error("No se pudo cargar la imagen");
                }
                $("#enslider").load("mostrarImgSlider.php", function() {
                });
            });
        }
    }
    return 0;
}



function borrarSlider(idImgslider, idSucursal, ruta) {
    alertify.confirm("¿Estas completamente seguro eliminar la imagen seleccionada?, Esta acción no puede deshacerse. ", function(e) {
        if (e) {
            var info = "idImgslider=" + idImgslider + "&idSucursal=" + idSucursal + "&ruta=" + encodeURIComponent(ruta);
            $.get('borrarSlider.php', info, function(r) {
                if (r == 777) {
                    alertify.success("Imagen eliminada");
                    $("#enslider").load("mostrarImgSlider.php", function() {
                    });
                } else {
                    alertify.error("No se pudo eliminar la imangen");
                }
            });
        } else {
        }
    });
}

$("#btnnopublicados").click(function() {
    $("#divnopublicados").load("buscarNoPublicados.php", function() {
        $("#tdnopublicados").dataTable();
    });
    $("#mdlnopublicados").modal('toggle');
});

function publicamelo(codigo) {
    $("#mdlnopublicados").modal('toggle');
    $("#clascodigoproducto").val(codigo);
    damedatosclasificados();

}
