var archivos;
function handleFileSelect(evt) {
    var files = evt.target.files; // FileList object
 archivos = files;
    // files is a FileList of File objects. List some properties.
    var output = [];
    for (var i = 0, f; f = files[i]; i++) {
       var fileName = f.name;
       
      var fileExtension = fileName.substring(fileName.lastIndexOf('.') + 1);
      output.push('<li><strong>', escape(f.name), '</strong> (', fileExtension || 'n/a', ') - ',
                  f.size, ' bytes, last modified: ',
                  f.lastModifiedDate.toLocaleDateString(), '</li>');
    }
    document.getElementById('list').innerHTML = '<ul>' + output.join('') + '</ul>';
  }

  document.getElementById('files').addEventListener('change', handleFileSelect, false);

$(document).ready(function() {
       
    $("#subirImagenes").click(function(){
//       alert(archivos);
        var data = new FormData();
//        alert(archivos.length);
         for (i = 0; i < archivos.length; i++) {
                data.append('archivo' + i, archivos[i]);
//                alert(archivos[i]);
            }
            data.append('descripcion', probando = $("#descripcion").val());
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
               alertify.error(msg);
            });
        
    });
});
