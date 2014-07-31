$(document).ready(function() {
    var code_prod = $("#buzon_code").val();
    $("#mostrarnovedades").load("mostrarNovedades.php", function() {
    });
    $("#mostrarcategorias").load("mostrarCategorias.php", function() {
    });
    mostrarDetalles(code_prod);
});

function mostrarDetalles(code_prod) {
    var info = "codigo=" + code_prod;
    $("#mostrardetalle").load("mostrarDetalles.php?" + info, function() {
        // Carousel (slider)
        $('#detailCarousel').carousel({
            interval: 4000
        });
        $('[id^=carousel-selector-]').click(function() {
            var id_selector = $(this).attr("id");
            var id = id_selector.substr(id_selector.length - 1);
            id = parseInt(id);
            $('#detailCarousel').carousel(id);
            $('[id^=carousel-selector-]').removeClass('selected');
            $(this).addClass('selected');
        });
        $('#detailCarousel').on('slid', function(e) {
            var id = $('.item.active').data('slide-number');
            id = parseInt(id);
            $('[id^=carousel-selector-]').removeClass('selected');
            $('[id^=carousel-selector-' + id + ']').addClass('selected');
        });
    });
}