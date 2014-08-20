/****** Creado por Franz Gualambo ***************/
/***** Email : gualambo@gmail.com  *****************/
(function(a){a.fn.validCampoFranz=function(b){a(this).on({keypress:function(a){var c=a.which,d=a.keyCode,e=String.fromCharCode(c).toLowerCase(),f=b;(-1!=f.indexOf(e)||9==d||37!=c&&37==d||39==d&&39!=c||8==d||46==d&&46!=c)&&161!=c||a.preventDefault()}})}})(jQuery);
//
////(function($) {
//    $.fn.validCampoFranz = function(cadena) {
//        $(this).on({
//            keypress: function(e) {
//                var key = e.which,
//                        keye = e.keyCode,
//                        tecla = String.fromCharCode(key).toLowerCase(),
//                        letras = cadena;
//                if (letras.indexOf(tecla) == -1 && keye != 9 && (key == 37 || keye != 37) && (keye != 39 || key == 39) && keye != 8 && (keye != 46 || key == 46) || key == 161) {
//                    e.preventDefault();
//                }
//            }
//        });
//    };
//})(jQuery);