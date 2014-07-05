var archivos;
var grupo = "";
var arrelo;
var imagenes = new Array();
var calculando = 6;
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
function eliminandoImagenes(imagen, idImagen, cont) {
    var arreglo = new Array();
    alertify.confirm("¿Estas completamente seguro de querer eliminar esta imagen?, Al guardar cambios ya no se podra recuperar. ", function(e) {
        if (e) {
            arreglo = {imagen: imagen, idImagen: idImagen};
            imagenes.push(arreglo);
            console.log(imagenes);
            $("#contenedor" + cont).hide("slow");
            calculando = calculando + 1;
            $("#textoValor").text("Puedes subir maximo " + calculando + " imagenes");
        } else {
            alertify.error("<img src='../subidas/okey.jpg' height='50%' width='50%'>");
        }
    });



}

function handleFileSelect(evt) {
//    alert("entro");
    var files = evt.target.files; // FileList object
    archivos = files;
    // files is a FileList of File objects. List some properties.
    var output = [];
    if (archivos.length <= calculando) {
        for (var i = 0, f; f = files[i]; i++) {
            var fileName = f.name;
            var fileExtension = fileName.substring(fileName.lastIndexOf('.') + 1);
            if (fileExtension !== "jpg" && fileExtension !== "png" && fileExtension !== "gif") {
                alertify.error("Solo puedes subir archivos jpg, gif y png")


            } else {
//
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

document.getElementById('files').addEventListener('change', handleFileSelect, false);
$(document).ready(function() {
    $("#limpiar").click(function() {
        limpiarCampos();
    })
    $("#editarImagenes").hide();
    $("#mostrarImagenes").hide();
    $("#mostrando").hide();
//    $("#selectTipo").selectpicker('hide');
//
//    $("#selectGrupo").load("mostrarGrupos.php", function() {
//        $("#selectGrupo").selectpicker();
//    });

//    $("#selectGrupo").change(function() {
//        if ($("#selectGrupo").val() == 0) {
//            $("#selectTipo").selectpicker('hide');
//
//        } else {
//           
//        }
//
//    });
    $("#clascodigoproducto").keypress(function(e) {
        if (e.which == 13) {
            var info = "codigoProducto=" + $("#clascodigoproducto").val();
            $.get("verificarExistenciaProducto.php", info, function(x) {

                var comprobante;
                var tipo;
                var descripcion;
                var imagenes;
                var idImagen;
                var novedades;
                var recomendado;
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
                        if (imagenes !== undefined) {
                            var imagen = "<img src='../subidas/" + imagenes + " ' />\n\
                                        <div class='caption'><p> <small> <center><button type='button' class='btn btn-xs' onclick=eliminandoImagenes('" + imagenes + "','" + idImagen + "','" + cont + "')><span class='glyphicon glyphicon-remove'></span></button></center></small > </p></div>";

                            $("#imagen" + cont).append(imagen);
                            $("#contenedor" + cont).show('slow');
//                            $("#imagen" + cont).prop("hidden",false);
                            cont++;
                            $("#mostrarImagenes").show("slow");
                        }
                        calculando = 6 - cont;
                        $("#textoValor").text("Puedes subir maximo " + calculando + " imagenes");
//                         imagen='<img src="../subidas/"' +imagenes+' />';

                    });
                });
//                grupo = x;
                if (grupo !== "" && grupo !== undefined) {
                    $("#mostrando").show();
                    $("#clascodigoproducto").prop("disabled", true);
                    $("#selectTipo").load("mostrarTiposProducto.php?idGrupo=" + grupo, function() {
                        $("#selectTipo").selectpicker();
                        $("#selectTipo").selectpicker('refresh');
                        $("#selectTipo").selectpicker('show');
                        if (comprobante == "1") {
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
    })

    $("#btnGuardarTipo").click(function() {
        info = "nombreTipo=" + $("#txtnombreTipo").val() + "&idGrupo=" + grupo;
        $.get("guardarTipo.php", info, function(x) {
            if (x == 999) {
                alertify.error("No funciono");
            } else {
                $("#selectTipo").load("mostrarTiposProducto.php?idGrupo=" + grupo, function() {
                    $("#selectTipo").selectpicker();
                    $("#selectTipo").selectpicker('refresh');
                    $("#selectTipo").selectpicker('show');
                });
                alertify.success("Guardado Tipo");
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
            data.append('descripcion', probando = $("#descripcion").val());
            data.append('codigoProducto', probando = $("#clascodigoproducto").val());
//        data.append('grupo', probando = $("#selectGrupo").val());
            data.append('tipo', probando = $("#selectTipo").val());
            data.append('novedades', novedades);
            data.append('recomendado', recomendados);
            data.append('faltantes', calculando)
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
                alertify.success(msg);
                limpiarCampos();
            });
        } else {
            alertify.error("Debes llenar los campos obligatorios");
        }



    });

    $("#editarImagenes").click(function() {
        if ($("#descripcion").val() !== "" && $("#clascodigoproducto").val() !== "" && $("#selectTipo").val() !== "") {
            if (calculando < 5 || $("#files").val() !== "") {
                //       alert(archivos);
                var data = new FormData();
                var listaImagenes = "";
                if (archivos !== undefined) {
                    for (i = 0; i < archivos.length; i++) {
                        data.append('archivo' + i, archivos[i]);
//                alert(archivos[i]);
                    }

                }



                var nov = $("#Novedades").is(":checked");
                var reco = $("#recomendado").is(":checked");
//                alert("nov="+ nov);
//                alert("reco="+ reco);
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
//                alert("entro" + calculando);

                listaImagenes = JSON.stringify(imagenes);
                data.append('descripcion', probando = $("#descripcion").val());
                data.append('codigoProducto', probando = $("#clascodigoproducto").val());
//        data.append('grupo', probando = $("#selectGrupo").val());
                data.append('tipo', probando = $("#selectTipo").val());
                data.append('novedades', novedades);
                data.append('recomendado', recomendados);
                data.append('imagenesBorradas', listaImagenes);
//            alert(data);
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
                    alertify.success(msg);
                    limpiarCampos();
                });
            } else {
                alertify.error("Debes Haber almenos una imagen para mostrar");
            }

        } else {
            alertify.error("Debes llenar los campos obligatorios");
        }



    });
});
