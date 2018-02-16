(function(window, document, $) {
    'use strict';

    $('[data-mask-reference=cpf]').mask('000.000.000-00');
    $('[data-mask-reference=phone]').mask('(00) 00000-0009');
    $('[data-mask-reference=date]').mask('00/00/0000');
    $("[data-mask-reference=decimal]").mask("#.##0,00", { reverse: true });

})(window, document, jQuery);