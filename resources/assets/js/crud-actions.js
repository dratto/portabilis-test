(function(window, document, $) {
    'use strict';

    $('.remove-action').on('click', function() {
        return confirm('Deseja realmente deletar?');
    });

})(window, document, jQuery);